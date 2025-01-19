let map;
const cityList = document.getElementById("city-list");
const distanceList = document.getElementById("distance-list");
const priceList = document.getElementById("price-list");
const ratingList = document.getElementById("rating-list");
const searchButton = document.getElementById("btnSearch");
const geocoder = new google.maps.Geocoder();
let markersArray = [];

initializeMap();

// Populate dropdowns
function fillCityDropdown() {
    fetch("./latvia_cities.json")
        .then((res) => res.json())
        .then((data) => {
            const combinedArray = [...data.cities, ...data.municipalities];
            combinedArray.forEach((city) => {
                const option = document.createElement("option");
                option.value = city;
                option.textContent = city;
                cityList.appendChild(option);
            });
        })
        .catch((error) => console.error("Error fetching cities:", error));
}

function fillDistanceDropdown() {
    const distances = [
        "5 km",
        "10 km",
        "15 km",
        "20 km",
        "25 km",
        "50 km",
        "100 km",
        "150 km",
    ];
    distances.forEach((distance) => {
        const option = document.createElement("option");
        option.value = distance;
        option.textContent = distance;
        distanceList.appendChild(option);
    });
}

function fillRatingDropdown() {
    const ratings = ["★☆☆☆☆", "★★☆☆☆", "★★★☆☆", "★★★★☆", "★★★★★"];
    ratings.forEach((rating, index) => {
        const option = document.createElement("option");
        option.value = index + 1;
        option.textContent = rating;
        ratingList.appendChild(option);
    });
}
function fillPriceDropdown() {
    const prices = ["<5€", "5-10€", ">10€"];
    prices.forEach((price) => {
        const option = document.createElement("option");
        option.value = price;
        option.textContent = price;
        priceList.appendChild(option);
    });
}

fillCityDropdown();
fillDistanceDropdown();
fillRatingDropdown();
fillPriceDropdown();

// Initialize the map
function initializeMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 56.946, lng: 24.105 }, // Default center (Riga)
        zoom: 8,
    });
}

// Handle user location
const btnUserLocation = document.getElementById("btnUserLocation");
if (btnUserLocation) {
    btnUserLocation.addEventListener("click", () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                // Clear old markers/circles
                if (currentMarker) currentMarker.setMap(null);
                if (currentCircle) currentCircle.setMap(null);

                setTimeout(() => scrollWindow("#map", -100), 800);

                // Add new marker
                currentMarker = new google.maps.Marker({
                    position: userLocation,
                    map: map,
                    title: "Your location",
                });

                setTimeout(() => {
                    map.setCenter(userLocation);
                    map.setZoom(12);
                }, 1000);

                const selectedDistance = parseInt(
                    distanceList.value.replace(" km", ""),
                    10
                );
                const selectedRating = parseFloat(ratingList.value) || 0;

                currentCircle = new google.maps.Circle({
                    center: userLocation,
                    radius: (selectedDistance * 1000) / 2,
                    map: map,
                    fillColor: "#FF0000",
                    fillOpacity: 0.3,
                    strokeColor: "#FF0000",
                    strokeOpacity: 0.6,
                    strokeWeight: 2,
                });
                searchNearbyPlaces(
                    userLocation,
                    selectedDistance * 1000,
                    selectedRating
                );
            });
        }
    });
}

let currentMarker = null;
let currentCircle = null;

function changeMapCity(selectedCity, radiusKM, selectedRating) {
    if (selectedCity && selectedCity !== "All Latvia") {
        geocoder.geocode({ address: selectedCity }, (results, status) => {
            if (status === "OK") {
                const location = results[0].geometry.location;

                // Clear old markers/circles
                if (currentMarker) currentMarker.setMap(null);
                if (currentCircle) currentCircle.setMap(null);

                // Add new marker and circle
                currentMarker = new google.maps.Marker({
                    position: location,
                    map: map,
                    title: selectedCity,
                });

                if (radiusKM) {
                    currentCircle = new google.maps.Circle({
                        center: location,
                        radius: (radiusKM * 1000) / 2,
                        map: map,
                        fillColor: "#FF0000",
                        fillOpacity: 0.3,
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.6,
                        strokeWeight: 2,
                    });
                }

                map.setCenter(location);
                map.setZoom(12);

                // Search nearby places
                searchNearbyPlaces(
                    location,
                    (radiusKM * 1000) / 2,
                    selectedRating
                );
            } else {
                console.error("Geocoding failed:", status);
            }
        });
    }
}

let allResults = []; // Store all fetched results

function searchNearbyPlaces(
    center,
    radius,
    selectedRating,
    nextPageToken = null
) {
    const service = new google.maps.places.PlacesService(map);

    const request = {
        location: center,
        radius: radius,
        type: "restaurant",
        pagetoken: nextPageToken,
    };

    service.nearbySearch(request, (results, status, pagination) => {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            const filteredResults = [];
            for (let i = 0; i < results.length; i++) {
                const place = results[i];
                if (place.rating && place.rating >= selectedRating) {
                    filteredResults.push(place);
                }
            }

            ClearMarkers();

            handleSearchResults(filteredResults, radius, pagination);

            AddMarkers(filteredResults);
        } else {
            console.error("Places search failed:", status);
            handleSearchResults([], radius, null);
        }
    });
}

let currentPage = 1;
const placesPerPage = 20;

function handleSearchResults(results, radius, pagination) {
    allResults = allResults.concat(results); // Append new results to the global array

    updatePlacesHeading(allResults.length, radius / 1000);
    displayPlaces(allResults, pagination);
}

function updatePlacesHeading(count, radius) {
    const cityText = cityList.value;
    const heading = document.getElementById("places-heading");

    if (count > 0) {
        heading.textContent = `Found ${count} places in ${cityText} within ${radius} km.`;
    } else {
        heading.textContent = "No places found.";
    }
}

function displayPlaces(places, pagination) {
    const pageNumber = document.getElementById("pageNumber");
    const container = document.getElementById("places-container");
    container.innerHTML = ""; // Clear previous content
    pageNumber.innerHTML = currentPage;

    const startIndex = (currentPage - 1) * placesPerPage;
    const endIndex = startIndex + placesPerPage;

    const currentPlaces = places.slice(
        startIndex,
        Math.min(endIndex, places.length)
    );

    console.log("Start index:", startIndex);
    console.log("End index:", endIndex);
    console.log("Current places:", currentPlaces);
    console.log("Current page:", currentPage);

    currentPlaces.forEach((place) => {
        const colDiv = document.createElement("div");
        colDiv.className = "col-md-4 mb-4";

        const cardDiv = document.createElement("div");
        cardDiv.className = "card";

        const cardBody = document.createElement("div");
        cardBody.className = "card-body";

        const title = document.createElement("h5");
        title.className = "card-title";
        title.textContent = place.name;

        const text = document.createElement("p");
        let photoUrl = "https://dummyimage.com/400x300/000/fff&text=No+Image";
        if (place.photos && place.photos.length > 0) {
            photoUrl = place.photos[0].getUrl({});
        }

        text.className = "card-text";
        text.innerHTML = `
                ${place.vicinity || "Unknown address"}<br>
                Rating: ${place.rating || "Not available"}<br>
                <img src="${photoUrl}" alt="Place photo">`;

        cardBody.appendChild(title);
        cardBody.appendChild(text);
        cardDiv.appendChild(cardBody);
        colDiv.appendChild(cardDiv);

        container.appendChild(colDiv);
    });

    const nextButton = document.getElementById("nextButton");
    const backButton = document.getElementById("backButton");

    // NEXT BUTTON
    if (pagination.hasNextPage) {
        nextButton.style.display = "block";
        nextButton.onclick = () => {
            scrollWindow("#places-container", -100);
            pagination.nextPage(); //Fetch the next page
            currentPage++;
            displayPlaces(allResults, pagination); // Render updated results
        };
    } else if (places.length > endIndex) {
        nextButton.style.display = "block";
        nextButton.onclick = () => {
            currentPage++;
            displayPlaces(allResults, pagination); // Render next slice of existing results
        };
    } else {
        nextButton.style.display = "none";
    }

    // BACK BUTTON
    if (currentPage > 1) {
        backButton.style.display = "block";
        backButton.onclick = () => {
            scrollWindow("#places-container", -100);
            currentPage--;
            displayPlaces(allResults, pagination);
        };
    } else {
        backButton.style.display = "none";
    }
}

searchButton.addEventListener("click", (event) => {
    event.preventDefault();

    const selectedCity = cityList.value;
    const selectedDistance = parseInt(
        distanceList.value.replace(" km", ""),
        10
    );
    const selectedRating = parseFloat(ratingList.value) || 0;

    resetPagination();
    setTimeout(() => scrollWindow("#map", -100), 800);
    setTimeout(() => {
        changeMapCity(selectedCity, selectedDistance, selectedRating);
    }, 1000);
});

function AddMarkers(places) {
    for (let i = 0; i < places.length; i++) {
        const place = places[i];

        const marker = new google.maps.Marker({
            map: map,
            position: place.geometry.location,
            title: place.name,
        });
        markersArray.push(marker);
        const infowindow = new google.maps.InfoWindow({
            content: "<h3>" + place.name + "</h3><p>" + place.vicinity + "</p>",
        });

        marker.addListener("click", function () {
            console.log("click");
            infowindow.open(map, marker);
        });
    }
}

function ClearMarkers() {
    if (markersArray) {
        for (let i in markersArray) {
            markersArray[i].setMap(null);
        }
    }
    markersArray = [];
}

function scrollWindow(target, offset = 0) {
    const element = document.querySelector(target);
    const position = element.getBoundingClientRect().top + window.scrollY;

    window.scrollTo({
        top: position + offset,
        behavior: "smooth",
    });
}

function resetPagination() {
    currentPage = 1;
    allResults = [];
}

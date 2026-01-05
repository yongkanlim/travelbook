// List of keywords for random attraction images
const keywords = [
    'tourism', 'landscape', 'nature', 'travel', 
    'city', 'mountains', 'scenery', 'beach', 'vacation'
];

const backgroundDiv = document.getElementById('attraction-background');

// Function to generate a random LoremFlickr URL
function getRandomImageUrl() {
    const keyword = keywords[Math.floor(Math.random() * keywords.length)];
    // Adding Date.now() prevents caching, so always random
    return `https://loremflickr.com/1600/900/${keyword}?random=${Date.now()}`;
}

// Function to preload image
function preloadImage(url, callback) {
    const img = new Image();
    img.src = url;
    img.onload = callback; // call callback once loaded
}

// Function to change background smoothly without showing blank
function changeBackground() {
    const nextImage = getRandomImageUrl();

    // Preload the next image first
    preloadImage(nextImage, () => {
        // Fade out slightly
        backgroundDiv.style.transition = 'opacity 0.5s ease-in-out';
        backgroundDiv.style.opacity = 0.8; // slight fade

        // Swap background
        backgroundDiv.style.backgroundImage = `url('${nextImage}')`;

        // Fade back to full opacity
        setTimeout(() => {
            backgroundDiv.style.opacity = 1;
        }, 50); // tiny delay for smooth effect
    });
}

// Initial background
changeBackground();

// Change every 10 seconds
setInterval(changeBackground, 10000);

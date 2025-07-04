import { gsap } from "gsap";

import { ScrollTrigger } from "gsap/ScrollTrigger";
// ScrollSmoother requires ScrollTrigger
import { ScrollSmoother } from "gsap/ScrollSmoother";

gsap.registerPlugin(ScrollTrigger,ScrollSmoother);

document.addEventListener('DOMContentLoaded', function() {

    const existingImg = document.getElementById('mainbackground');

    function handleImageLoad() {
        console.log('Existing image loaded successfully!');
        // Initialize ScrollSmoother after the image has loaded
        runScrollSmoother();
    }

    existingImg.onload = handleImageLoad;
    existingImg.onerror = function() {
        console.error('Existing image failed to load!');
    };

    // If the image is already loaded (from cache), trigger handler immediately
    if (existingImg.complete && existingImg.naturalHeight !== 0) {
        handleImageLoad();
    }

    // Initialize cloud animations regardless of image load state
    initCloudAnimations();

});

const gsapContainer = [];

function initCloudAnimations() {
    // Get all cloud images and their wrapper divs
    const clouds = document.querySelectorAll('.cloud');

    console.log(`Found ${clouds.length} clouds to animate`);

    clouds.forEach((cloudImg, index) => {
        const wrapper = cloudImg.parentElement;

        // Get data attributes from the cloud image
        const direction = cloudImg.getAttribute('data-direction') || 'left';
        const speed = parseInt(cloudImg.getAttribute('data-speed')) || 1;

        // Set initial hidden state relative to the wrapper
        gsap.set(cloudImg, {
            opacity: 0,
            scale: 0.8,
            // Use relative positioning within the wrapper
            position: 'relative',
            left: direction === 'left' ? '-50px' : '50px',
            top: '20px'
        });

        // Entrance animation when wrapper enters viewport
        gsap.to(cloudImg, {
            opacity: 1,
            scale: 1,
            left: '0px',
            top: '0px',
            duration: 1.2 + Math.random() * 0.5,
            ease: "back.out(1.7)",
            scrollTrigger: {
                trigger: wrapper,
                start: "top 85%", // When wrapper is 85% down the viewport
                end: "top 15%",   // When wrapper is 15% down the viewport
                toggleActions: "play none none reverse",
                markers: false, // Enable to see trigger points
                id: `cloud-${index}`,
                onEnter: () => console.log(`Cloud ${index} entered viewport`),
                onLeave: () => console.log(`Cloud ${index} left viewport`),
                refreshPriority: -1
            },
            delay: index * 0.15
        });

        // Floating animation using transforms (works better with nested positioning)
        gsap.to(cloudImg, {
            y: 8,
            rotation: direction === 'left' ? 2 : -2,
            duration: 2.5 + Math.random() * 1.5,
            ease: "sine.inOut",
            yoyo: true,
            repeat: -1,
            delay: 1.5 + Math.random() // Start after entrance
        });

        // Parallax effect using transforms
        gsap.to(cloudImg, {
            yPercent: speed * -20, // Use percentage for better relative positioning
            ease: "none",
            scrollTrigger: {
                trigger: wrapper, // Use individual wrapper for more precise control
                start: "top bottom",
                end: "bottom top",
                scrub: 1.5,
                id: `parallax-${index}`,
                refreshPriority: 1
            }
        });

        // Horizontal drift using transforms
        gsap.to(cloudImg, {
            x: direction === 'left' ? 12 : -12,
            duration: 4 + Math.random() * 2,
            ease: "sine.inOut",
            yoyo: true,
            repeat: -1,
            delay: 2 + Math.random()
        });

        // Add subtle scale breathing for variety
        if (index % 2 === 0) { // Only on even indexed clouds
            gsap.to(cloudImg, {
                scale: 1.05,
                duration: 3 + Math.random() * 2,
                ease: "sine.inOut",
                yoyo: true,
                repeat: -1,
                delay: Math.random() * 3
            });
        }
    });

    // Refresh ScrollTrigger after setup
    ScrollTrigger.refresh();
}

function runScrollSmoother() {
    ScrollSmoother.create({
      smooth: 2, // how long (in seconds) it takes to "catch up" to the native scroll position
      effects: true, // looks for data-speed and data-lag attributes on elements
      smoothTouch: 0.1, // much shorter smoothing time on touch devices (default is NO smoothing on touch devices)
    });
}


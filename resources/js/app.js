import './bootstrap';

let getAllButtons = document.querySelectorAll('a.smooth')
 getAllButtons.forEach(itemMenu => {
    itemMenu.addEventListener('click',(e)=>{
        e.preventDefault();
        function smoothScroll(target, duration) {
            let getHash = document.querySelector(target)
            let targetPosition = getHash.getBoundingClientRect().top
            let startPosition = window.pageYOffset;
            let distance = targetPosition
            let startTime = null
            function animation(currentTime){
                if(startTime === null) startTime = currentTime
                let timeElapsed = currentTime - startTime
                let run = ease(timeElapsed, startPosition, distance, duration)
                window.scrollTo(0, run)
                if(timeElapsed < duration) requestAnimationFrame (animation)
            }
            function ease(t, b, c, d) {
                t /= d / 2
                if(t < 1) return c / 2 * t * t + b
                t--
                return -c / 2 * (t * (t - 2) - 1) + b
            }
            requestAnimationFrame(animation)
        }
        smoothScroll(`${itemMenu.hash}`, 1000)
    })
 });
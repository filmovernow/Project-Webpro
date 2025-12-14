function scrollMovies(containerId, direction) {
    const container = document.getElementById(containerId);
    if (!container) return;

    const screenWidth = window.innerWidth;
    let distance = 0;

    if (screenWidth < 480) 
    { 
        distance = 215; 
    } 
    else if (screenWidth >= 481 && screenWidth < 1024) 
    {
        distance = 645; 
    } 
    else 
    {
        distance = 1075; 
    }

    if (!direction) 
    {
        distance = -distance; //normally scroll right but if pass false, it will scroll left
    }

    container.scrollBy({left: distance, behavior: 'smooth'});
}
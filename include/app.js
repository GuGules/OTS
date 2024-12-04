function copyLink(){
    const link = document.getElementById('link');
    console.log(link.getAttribute('href'));
    navigator.clipboard.writeText(link.getAttribute('href'));
    // alert('Link copied to clipboard!');
}
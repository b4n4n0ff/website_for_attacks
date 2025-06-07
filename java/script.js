let shown = true;

function toggleImagesAndText() {
    let imgs = document.querySelectorAll('img');
    let texts = document.querySelectorAll('p, h1, h3');

    imgs.forEach(img => {
        img.style.display = shown ? 'none' : 'block';
    });

    texts.forEach(el => {
        el.style.color = shown ? 'red' : 'black';
    });

    shown = !shown;
}

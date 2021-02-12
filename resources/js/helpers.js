
function removeClassFromNodes(nodes, nodeClass) {
    Array.prototype.forEach.call(nodes, function (el,i) {
        el.classList.remove(nodeClass);
    });
}



function loadImageWithCallBack (src, fn) {
    const image = new Image ();
    image.src = src;
    image.onload = fn;
}


export { removeClassFromNodes , loadImageWithCallBack }

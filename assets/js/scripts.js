function handleImg(event) {
  let getHiddenImg = document.getElementById("hiddenImg");
  getHiddenImg.src = URL.createObjectURL(event.target.files[0]);

  const canvas = document.getElementById("imageCanvasPreview");
  let ctx = canvas.getContext("2d");
  let reader = new FileReader();
  reader.onload = function(event) {
    let img = new Image();
    img.onload = function() {
      // console.log("cw", canvas.width);
      // canvas.style.width = "100%";
      // canvas.width = img.width;
      // canvas.height = img.height;
      // ctx.scale(1, 1);

      // ctx.drawImage(img, 0, 0, img.width, img.height, 0, 0, canvas.width, canvas.height);

      let imageRatio = img.width / img.height;
      let offsetX = 0;
      let offsetY = 0;
      let scaledWidth = 300;
      let scaledHeight = 300;
      let pixelRatio = Math.round(window.devicePixelRatio || window.screen.deviceXDPI / window.screen.logicalXDPI);
      ctx.scale(pixelRatio, pixelRatio);
      const previewRatio = 300 / 300;
      
      if (imageRatio >= previewRatio) {
        scaledHeight = scaledWidth / imageRatio;
        offsetY = (300 - scaledHeight) / 2;
      } else {
        scaledWidth = scaledHeight * imageRatio;
        offsetX = (300 - scaledWidth) / 2;
      }

      canvas.style.background = 'none';
      canvas.width = 300 * pixelRatio;
      canvas.height = 300 * pixelRatio;
      ctx.setTransform(1, 0, 0, 1, 0, 0);
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      if (this.rotate) {
        ctx.translate(offsetX * pixelRatio, offsetY * pixelRatio);
        ctx.translate(scaledWidth / (2 * pixelRatio), scaledHeight / (2 * pixelRatio));
        ctx.rotate(this.rotate);
        offsetX = -scaledWidth / 2;
        offsetY = -scaledHeight / 2;
      }
      ctx.drawImage(img,
        offsetX * pixelRatio,
        offsetY * pixelRatio,
        scaledWidth * pixelRatio,
        scaledHeight * pixelRatio);

    };
    img.src = event.target.result;
  };
  reader.readAsDataURL(event.target.files[0]);
}
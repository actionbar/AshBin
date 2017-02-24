(function() {
  function ResizeImg() {

  }

  ResizeImg.prototype = {
    maxWidth: 0,
    maxHeight: 0,
    setRange: function () {
      this.maxWidth = parseInt(arguments[0]);
      this.maxHeight = parseInt(arguments[1]);
    },
    resize: function (width, height) {
      width = parseInt(width);
      height = parseInt(height);
      if (this.maxWidth > 0 && width > this.maxWidth) {
        height *= this.maxWidth / width;
        width = this.maxWidth;
      }
      if (this.maxHeight > 0 && height > this.maxHeight) {
        width *= this.maxHeight / height;
        height = this.maxHeight;
      }
      return {'width': parseInt(width), 'height': parseInt(height)};

    }
  };
  window.ResizeImg = new ResizeImg();
})();
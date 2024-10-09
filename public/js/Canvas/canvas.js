function drawImageInShape(imageSrc, shapeCoordinates) {
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    const img = new Image();
    img.src = imageSrc;
    img.onload = function() {
        ctx.beginPath();
        ctx.moveTo(shapeCoordinates[0][0], shapeCoordinates[0][1]);
        // 座標に基づいて形を描く
        shapeCoordinates.forEach(coord => ctx.lineTo(coord[0], coord[1]));
        ctx.closePath();
        ctx.clip(); // 形に沿ってクリッピング
        ctx.drawImage(img, 0, 0); // 画像を描画
    };
}

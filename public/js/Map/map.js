window.addEventListener('DOMContentLoaded', () => {
    const map = L.map('map',{
        zoomControl: false,  // ズームコントロールを無効にする
        scrollWheelZoom: false,  // マウスホイールによるズームを無効にする
        doubleClickZoom: false,  // ダブルクリックによるズームを無効にする
        boxZoom: false,  // ボックスズームを無効にする
        touchZoom: false  // タッチ操作によるズームを無効にする
    }).setView([35.6762, 139.6503], 5);

    // 投稿データを取得
    fetch('/api/posts')
        .then(response => response.json())
        .then(postData => {
            // GeoJSON データを取得 (japan.geojson)
            fetch('/geojson/japan.geojson')
                .then(response => response.json())
                .then(geoJsonData => {
                    L.geoJson(geoJsonData, {
                        style: function (feature) {
                            const prefId = feature.properties.pref; // GeoJSONの都道府県ID（pref）
                            const post = postData.find(p => p.location_id == prefId); // 投稿データのlocation_idと一致するものを探す
                            console.log('Prefecture ID:', prefId); // デバッグ用
                            console.log('Post found:', post); // postがあるか確認

                            if (post && post.image_path) {
                                return {
                                    fillColor: 'rgba(255, 0, 0, 0)', // 完全透明にする
                                    fillOpacity: 0, // 塗りつぶしの透明度を完全にする
                                    color: 'white',
                                    weight: 1
                                };
                            } else {
                                return {
                                    fillColor: '#cccccc', // 投稿データがない場合は灰色にする
                                    color: 'white',
                                    weight: 1,
                                    fillOpacity: 0.7
                                };
                            }
                        },

                        onEachFeature: function (feature, layer) {
                            const prefId = feature.properties.pref;
                            const post = postData.find(p => p.location_id == prefId);

                            if (post && post.image_path) {
                                const postId = post.id || 'No ID';  // post.idが無い場合の確認
                                console.log('Post ID:', postId); // postのIDを確認
                                const imageUrl = post.image_path;
                                const bounds = layer.getBounds(); // 都道府県の境界

                                // キャンバスの作成
                                const canvas = document.createElement('canvas');
                                const context = canvas.getContext('2d');

                                const topLeft = map.latLngToLayerPoint(bounds.getNorthWest());
                                const bottomRight = map.latLngToLayerPoint(bounds.getSouthEast());

                                // Canvasサイズを境界に合わせる
                                canvas.width = bottomRight.x - topLeft.x;
                                canvas.height = bottomRight.y - topLeft.y;

                                // GeoJSON内の座標を取得してクリッピングパスを作成
                                const coordinates = feature.geometry.coordinates;

                                // 緯度経度をCanvas座標に変換してパスを作成
                                context.beginPath();
                                coordinates.forEach(polygon => {
                                    polygon.forEach(ring => {
                                        ring.forEach((coord, index) => {
                                            const lat = coord[1];
                                            const lng = coord[0];
                                            const point = map.latLngToLayerPoint([lat, lng]);

                                            const x = point.x - topLeft.x;
                                            const y = point.y - topLeft.y;

                                            if (index === 0) {
                                                context.moveTo(x, y);
                                            } else {
                                                context.lineTo(x, y);
                                            }
                                        });
                                    });
                                });
                                context.closePath();
                                context.clip(); // クリップパスを作成
                                
                                context.globalAlpha = 1.0;

                                // 画像をロードして描画
                                const image = new Image();
                                image.src = imageUrl;

                                image.onload = function () {
                                    context.drawImage(image, 0, 0, canvas.width, canvas.height);

                                    // canvasをleaflet地図の特定の位置に重ねる
                                    const overlayPane = map.getPanes().overlayPane;
                                    canvas.style.position = 'absolute';
                                    canvas.style.left = `${topLeft.x}px`;
                                    canvas.style.top = `${topLeft.y}px`;

                                    // Leaflet地図上にcanvasを追加
                                    overlayPane.appendChild(canvas);
                                };

                                image.onerror = function () {
                                    console.error("Image load failed:", imageUrl);
                                };

                                // ポップアップに詳細リンクを表示
                                layer.bindPopup(`<strong>${feature.properties.name}</strong><br>
                                    <img src="${imageUrl}" alt="picture" width="100"><br>
                                    <a href="/posts/${postId}" target="_blank">詳細を見る</a>`);  // リンクを追加
                            } else {
                                layer.bindPopup(`<strong>${feature.properties.name}</strong>`);
                            }
                        }
                    }).addTo(map);
                })
                .catch(error => {
                    console.error("GeoJSON fetch error:", error);
                });
        })
        .catch(error => {
            console.error("Posts fetch error:", error);
        });
});

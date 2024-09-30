window.addEventListener('DOMContentLoaded', () => {
    // 
    const map = L.map('map').setView([35.6762, 139.6503], 5);

    // fetch APIを用いて、GeoJsonデータを取得する
    fetch('/api/geojson')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            L.geoJson(data, {
                // 
                style: function (feature) {
                    // 
                    const post = feature.properties; // 各都道府県に関連する投稿データ

                    // 画像投稿されている都道府県であるか否かでの条件分岐
                    if (post.picture) {
                        // 画像がある場合に任意の色で塗りつぶす
                        return {
                            fillColor: '#ffcccb', // 画像がある県の色
                            fillOpacity: 0.7,
                            color: 'white',
                            weight: 1
                        };
                    } else {
                        return {
                            fillColor: '#cccccc', // 画像がない県の色
                            color: 'white',
                            weight: 1,
                            fillOpacity: 0.7
                        };
                    }
                },

                onEachFeature: function (feature, layer) {
                    const post = feature.properties;
                    if (post.picture) {
                        // 画像のポップアップを追加
                        layer.bindPopup(`<strong>${feature.properties.name}</strong><br><img src="" alt="picture" width="100">`);
                    } else {
                        // 都道府県名のみ表示
                        layer.bindPopup(`<strong>${feature.properties.name}</strong>`);
                    }
                }
            }).addTo(map);
        });
});
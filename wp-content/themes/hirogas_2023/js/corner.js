/*
document.addEventListener(
  "DOMContentLoaded",

  function () {
    // 指定されたクラス名のimg要素を取得
    const images = document.querySelectorAll(".img_photo_single");

    // 各画像の縦横比を調べて、クラスを付与
    images.forEach((image) => {
      const width = image.naturalWidth;
      const height = image.naturalHeight;
      const aspectRatio = width / height;

      if (aspectRatio < 1.1) {
        image.classList.add("vertical");
      } else {
        image.classList.add("horizontal");
      }
    });
  }
);
*/

document.addEventListener(
  "DOMContentLoaded",

  function () {
    // クラス名.imgの各画像に対して角を丸くする
    const images = document.querySelectorAll(".img_round");

    images.forEach((img) => {
      // canvas要素の作成
      const canvas = document.createElement("canvas");
      const ctx = canvas.getContext("2d");

      // 画像の読み込み
      const image = new Image();
      image.src = img.src;

      // 画像が読み込まれたら
      image.onload = () => {
        // canvasのサイズをブラウザ上で表示される画像のサイズに合わせる
        const ratio = Math.min(img.width / image.width, img.height / image.height);
        //imgが表示サイズ？
        //imageが実サイズ？
        const realWidth = img.naturalWidth;
        const realHeight = img.naturalHeight;
        const dpr = window.devicePixelRatio || 1;
        if (img.classList.contains("img_round_small") == true) {
          var multi = 0.5;
        } else {
          var multi = 1;
        }
        if (img.width > image.width) {
          canvas.width = image.width * ratio * 1;
          canvas.height = image.height * ratio * 1;
          cornerRadius = 7 * multi; //角丸サイズ：7px
          img.classList.add("small");
        } else {
          canvas.width = image.width * ratio * 2;
          canvas.height = image.height * ratio * 2;

          cornerRadius = 14 * multi; //角丸サイズ：7px
          img.classList.add("large");
        }

        // 画像をcanvasに描画
        ctx.drawImage(image, 0, 0, canvas.width, canvas.height);

        // canvasに角を丸くするフィルターをかける
        ctx.globalCompositeOperation = "destination-in";
        ctx.beginPath();
        //const cornerRadius = 1 * vwToPx(1);//角丸サイズ：1vw
        ctx.moveTo(cornerRadius, 0);
        ctx.lineTo(canvas.width - cornerRadius, 0);
        ctx.quadraticCurveTo(canvas.width, 0, canvas.width, cornerRadius);
        ctx.lineTo(canvas.width, canvas.height - cornerRadius);
        ctx.quadraticCurveTo(canvas.width, canvas.height, canvas.width - cornerRadius, canvas.height);
        ctx.lineTo(cornerRadius, canvas.height);
        ctx.quadraticCurveTo(0, canvas.height, 0, canvas.height - cornerRadius);
        ctx.lineTo(0, cornerRadius);
        ctx.quadraticCurveTo(0, 0, cornerRadius, 0);
        ctx.closePath();
        //ctx.imageSmoothingEnabled = false;//アンチエイリアス
        ctx.fill();
        // canvasをimgタグに変換
        img.src = canvas.toDataURL();
      };
    });

    // vwをpxに変換する関数
    /*
    function vwToPx(vw) {
      const width = window.innerWidth;
      return (width * vw) / 100;
    }
    */
  }
);

//chatgptオリジナル

/*
const images = document.querySelectorAll('.img');

images.forEach(img => {
  // canvas要素の作成
  const canvas = document.createElement('canvas');
  const ctx = canvas.getContext('2d');

  // 画像の読み込み
  const image = new Image();
  image.src = img.src;

  // 画像が読み込まれたら
  image.onload = () => {
    // canvasのサイズをブラウザ上で表示される画像のサイズに合わせる
    const ratio = Math.min(img.width / image.width, img.height / image.height);
    canvas.width = image.width * ratio;
    canvas.height = image.height * ratio;

    // 画像をcanvasに描画
    ctx.drawImage(image, 0, 0, canvas.width, canvas.height);

    // canvasに角を丸くするフィルターをかける
    ctx.filter = 'blur(0px) opacity(100%) drop-shadow(0px 0px 0px rgba(0,0,0,0)) brightness(100%) contrast(100%) saturate(100%)';
    ctx.globalCompositeOperation = 'destination-in';
    ctx.beginPath();
    const cornerRadius = 3 * vwToPx(1);
    ctx.moveTo(cornerRadius, 0);
    ctx.lineTo(canvas.width - cornerRadius, 0);
    ctx.quadraticCurveTo(canvas.width, 0, canvas.width, cornerRadius);
    ctx.lineTo(canvas.width, canvas.height - cornerRadius);
    ctx.quadraticCurveTo(canvas.width, canvas.height, canvas.width - cornerRadius, canvas.height);
    ctx.lineTo(cornerRadius, canvas.height);
    ctx.quadraticCurveTo(0, canvas.height, 0, canvas.height - cornerRadius);
    ctx.lineTo(0, cornerRadius);
    ctx.quadraticCurveTo(0, 0, cornerRadius, 0);
    ctx.closePath();
    ctx.fill();

    // canvasをimgタグに変換
    img.src = canvas.toDataURL();
  };
});

// vwをpxに変換する関数
function vwToPx(vw) {
  const width = window.innerWidth;
  return width * vw / 100;
}
*/

const puppeteer = require('puppeteer');
const delay = ms => new Promise(res => setTimeout(() => {res()}, ms));

const fs = require("fs");

const readFile = ()=> {
  const data = JSON.parse(fs.readFileSync("./data.json", {encoding: "utf8"}));
  return data;
}
const writeFile = data => {
  return new Promise((res, rej) => {
    fs.writeFile("./data.json", JSON.stringify(data), "UTF-8", () => res());
  });
}


(async () => {

  var hoy = new Date().toISOString().split("T")[0];

  var allData = readFile();

  const browser = await puppeteer.launch({headless: false});
  const page = await browser.newPage();
  await page.setUserAgent('Mozilla/5.0 (Macintosh; Intel Mac OS X x.y; rv:42.0) Gecko/20100101 Firefox/42.0');

  await delay(2000);
  await page.goto('https://www.idealista.com/');

  await delay(2000);
  
  await page.evaluate(() => {
    if (window.document.querySelector("#didomi-notice-agree-button")) {
      window.document.querySelector("#didomi-notice-agree-button").click();;
    }
    window.document.querySelector("#your-account").querySelector("a").click();;
  });

  await page.waitForNavigation();
  await delay(2000);

  await page.evaluate(() => {
    window.document.querySelector("#email").value = "idealista@flying-taco.com";
    window.document.querySelector("input[name=pwd]").value = "lacasadelacarcasa1";

    window.document.querySelector("#doLogin").click();;
  });

  await page.waitForNavigation();
  await delay(2000);

  const newData = {...allData};

  for (var inmuebleUrl in allData) {
    if (!newData[inmuebleUrl]) {
      newData[inmuebleUrl] = [];
    }
    if (!allData[inmuebleUrl].find(data => data.fecha === hoy)) {
      newData[inmuebleUrl].push(await getDataOfInmueble(inmuebleUrl, page));
    }
  }

  await writeFile(newData);
  await browser.close();
  return;

  async function getDataOfInmueble(inmuebleUrl, page) {
    await page.goto(inmuebleUrl);

    await page.evaluate(() => {
      window.document.body.querySelector("#stats-ondemand").scrollIntoView();
    });
    await delay(1000);
  
    const visitas = await page.evaluate(() => {
      if (window.document.body.querySelector("#stats-ondemand").querySelector("strong")) {
        return window.document.body.querySelector("#stats-ondemand").querySelector("strong").innerHTML;
      }
  
    });
    const contactos = await page.evaluate(() => {
      if (window.document.body.querySelector("#stats-ondemand").querySelector("li:nth-child(2)")) {
        return window.document.body.querySelector("#stats-ondemand").querySelector("li:nth-child(2)").querySelector("strong").innerHTML;
      }
  
    });
    const favoritos = await page.evaluate(() => {
      if (window.document.body.querySelector("#stats-ondemand").querySelector("li:nth-child(3)")) {
        return window.document.body.querySelector("#stats-ondemand").querySelector("li:nth-child(3)").querySelector("strong").innerHTML;
      }
    });
  
  
    return {
      "visitas": visitas,
      "favorito": contactos,
      "contactos": favoritos,
      "fecha": hoy
    }
  }
  
})();


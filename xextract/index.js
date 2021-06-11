const puppeteer = require('puppeteer');
const delay = ms => new Promise(res => setTimeout(() => {console.log("final"); res()}, ms));
const readline = require('readline');
function askQuestion(query) {
  const rl = readline.createInterface({
      input: process.stdin,
      output: process.stdout,
  });

  return new Promise(resolve => rl.question(query, ans => {
      rl.close();
      resolve(ans);
  }))
}

const extractFromSelects = selectName => {
  return (selectName) => {
    const res = [];
    const options = window.document.querySelector(selectName).options;
    for (let i = 0; i < options.length; i++) {
      if (options[i].value) {
        res.push({value: options[i].value, name: options[i].innerHTML});
      }
    }
    return res
  }
}

const fs = require('fs');

const writeFile = data => {
  console.log(data);
  fs.writeFile("./data.json", JSON.stringify(data), "UTF-8", () => {
    console.log("iniciado");
  })
}

const readFile = ()=> {
  const data = JSON.parse(fs.readFileSync("./data-orig.json", {encoding: "utf8"}));
  console.log(data);
  return data;
}

const randomDelay = () => {
  return 2000 + (2000 * Math.random()); 
}
const longRandomDelay = () => {
  return (2 * 60 * 1000) + (60000 * Math.random()); 
}

const getGraphData = async (page) => {

  await page.click("#edit-submit");
  await delay(longRandomDelay());

  const resJSON = await page.evaluate(() => {
    if (document.querySelector("#graphall")) {
      const graphJSON = window.document.querySelector("#graphall").querySelector("div").getAttribute("data-chart");
      return JSON.parse(graphJSON);
    } else {
      return false;
    }
  });

  if (resJSON === false) {
    await askQuestion("La hemos liau? ");

    return await getGraphData(page);
  } else {
    return resJSON;

  }

}

const accumulator = {};
let resLevel1 = readFile();;

(async () => {
  const browser = await puppeteer.launch({headless: false});
  const page = await browser.newPage();
  await page.goto('https://www.idealista.com/sala-de-prensa/informes-precio-vivienda/');

  await askQuestion("Are you sure you want to deploy to PRODUCTION? ");

  if (!resLevel1) {
    resLevel1 = await page.evaluate(extractFromSelects("[name=location_level_1]"), "[name=location_level_1]");
  }
  writeFile(resLevel1);
  for (let i = 0; i < resLevel1.length; i++) {
    if (resLevel1[i].name !== "Melilla") continue
    console.log(resLevel1[i].name, new Date().toISOString());
    await page.select('[name=location_level_1]', resLevel1[i].value);
    await delay(randomDelay());
    if (!resLevel1[i].graph) {
      resLevel1[i].graph = await getGraphData(page);
      writeFile(resLevel1);
    }

    if (!resLevel1[i].children) {
      const resLevel2 = await page.evaluate(extractFromSelects("[name=location_level_2]"), "[name=location_level_2]");
      resLevel1[i].children = resLevel2
      writeFile(resLevel1);
    }


    for (let j = 0; j < resLevel1[i].children.length; j++) {
      console.log(resLevel1[i].children[j].name, new Date().toISOString());
      await page.select('[name=location_level_2]', resLevel1[i].children[j].value);
      await delay(randomDelay());


      if (!resLevel1[i].children[j].graph) {
        resLevel1[i].children[j].graph = await getGraphData(page);
        writeFile(resLevel1);
      }

      if (!resLevel1[i].children[j].children) {
        const resLevel3 = await page.evaluate(extractFromSelects("[name=location_level_3]"), "[name=location_level_3]");
        resLevel1[i].children[j].children = resLevel3
        writeFile(resLevel1);
      }

      for (let k = 0; k < resLevel1[i].children[j].children.length; k++) {
        console.log(resLevel1[i].children[j].children[k].name, new Date().toISOString());
        if (resLevel1[i].children[j].children[k].graph && resLevel1[i].children[j].children[k].children) continue;
        await page.select('[name=location_level_3]', resLevel1[i].children[j].children[k].value);
        await delay(randomDelay());


        if (!resLevel1[i].children[j].children[k].graph) {
          resLevel1[i].children[j].children[k].graph = await getGraphData(page);
          writeFile(resLevel1);
        }

        if (!resLevel1[i].children[j].children[k].children) {

          const resLevel4 = await page.evaluate(extractFromSelects("[name=location_level_4]"), "[name=location_level_4]");
          resLevel1[i].children[j].children[k].children = resLevel4
          writeFile(resLevel1);
        }
        for (let l = 0; l < resLevel1[i].children[j].children[k].children.length; l++) {
          console.log(resLevel1[i].children[j].children[k].children[l].name, new Date().toISOString());

          if (!resLevel1[i].children[j].children[k].children[l].graph) {
            await page.select('[name=location_level_4]', resLevel1[i].children[j].children[k].children[l].value);

            await delay(randomDelay());
            resLevel1[i].children[j].children[k].children[l].graph = await getGraphData(page);
            writeFile(resLevel1);
          }

        }

      }
    }

  }

  fs.writeFile("./data2.json", JSON.stringify(resLevel1, null, 2), "UTF-8", function (err) {
    if (err) throw err;
    console.log('Saved!');
  });
})();



const express = require('express')
const app = express()
const port = 3000
const fs = require('fs');

fs.writeFile("./data.txt", "", "UTF-8", () => {
  console.log("iniciado");
})
app.get('/', (req, res) => {
  console.log(req.query);
  fs.appendFile("./data.txt", req.query.param + "\n", "UTF-8", function (err) {
    if (err) throw err;
    console.log('Saved!');
  });

})

app.listen(port, () => {
  console.log(`Example app listening at http://localhost:${port}`)
})

for (let i = 0; i < $0.options.length; i++) {
  if ($0.options[i].value) {
  console.log($0.options[i].value);
  console.log($0.options[i]);
    fetch(`https://www.idealista.com/press-room/property-price-reports/rest/get-location-children/${$0.options[i].value}/?apiKey=2f206df8-42f6-4854-9b99-2e58dc6cb84f`)
      .then(res => res.json())
      .then(res => {
        fetch("http://localhost:3000?param=" + JSON.stringify(res));
        console.log(res)
        res.forEach(children => {
            fetch(`https://www.idealista.com/press-room/property-price-reports/rest/get-location-children/${children.serial}/?apiKey=2f206df8-42f6-4854-9b99-2e58dc6cb84f`)
              .then(res => res.json())
              .then(res => {
                fetch("http://localhost:3000?param=" + JSON.stringify(res));
                console.log(res)
                res.forEach(children => {

                  fetch(`https://www.idealista.com/press-room/property-price-reports/rest/get-location-children/${children.serial}/?apiKey=2f206df8-42f6-4854-9b99-2e58dc6cb84f`)
                  .then(res => res.json())
                  .then(res => {
                    fetch("http://localhost:3000?param=" + JSON.stringify(res));
                    console.log(res)
                    res.forEach(children => {
    
                      fetch(`https://www.idealista.com/press-room/property-price-reports/rest/get-location-children/${children.serial}/?apiKey=2f206df8-42f6-4854-9b99-2e58dc6cb84f`)
                      .then(res => res.json())
                      .then(res => {
                        fetch("http://localhost:3000?param=" + JSON.stringify(res));
                        console.log(res)
                        res.forEach(children => {
        
                        });
        
                      });
                    });
    
                  });
                });

              });
        });

      });
  }
}


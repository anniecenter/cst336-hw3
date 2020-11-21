<!DOCTYPE html>
<html>
    <head>
        <link href="./styles.css" rel="stylesheet" type="text/css" />
        <title>National PokeDex</title>
        <!-- Import PokéAPI -->
        <script src="https://pokeapi.co/api/v2/"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    
    <body>
        <h1 id="title">National PokeDex</h1>
        <select id="gen" name="gen">
            <option>Generation</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </select>
        <select id="pokemon" name="pokemon">
            <option>Pokemon</option>
        </select>
        <br><br>
        <div id="display">
            <div id="species"></div>
            <div id="dex"></div>
            <div id="type"></div>
            <div id="stats"></div>
        </div>
        <script>
            var nationalDex = [];
            
            $("#gen").on("change", async function() {
                let url = `https://pokeapi.co/api/v2/pokemon?offset=0&limit=890`;
                let response = await fetch(url);     //retrieves Web API data in raw format
                let data = await response.json();  //converts the raw data into JSON format
                
                //$("#pokemon").html("<option>Select One</option>");
                $("#pokemon").empty();
                $("#pokemon").html("<option>Pokemon</option>")
                
                if($("#gen").val() == 1) {
                    for (let i = 0; i < 151; i++) {
                        $("#pokemon").append(`<option value=${data.results[i].name}>${data.results[i].name.toUpperCase()}</option>}`);
                    }
                }
                else if($("#gen").val() == 2) {
                    for (let i = 151; i < 251; i++) {
                        $("#pokemon").append(`<option value=${data.results[i].name}>${data.results[i].name.toUpperCase()}</option>}`);
                    }
                }
                else if($("#gen").val() == 3) {
                    for (let i = 251; i < 386; i++) {
                        $("#pokemon").append(`<option value=${data.results[i].name}>${data.results[i].name.toUpperCase()}</option>}`);
                    }
                }
                else if($("#gen").val() == 4) {
                    for (let i = 386; i < 493; i++) {
                        $("#pokemon").append(`<option value=${data.results[i].name}>${data.results[i].name.toUpperCase()}</option>}`);
                    }
                }
                else if($("#gen").val() == 5) {
                    for (let i = 493; i < 649; i++) {
                        $("#pokemon").append(`<option value=${data.results[i].name}>${data.results[i].name.toUpperCase()}</option>}`);
                    }
                }
                else if($("#gen").val() == 6) {
                    for (let i = 649; i < 721; i++) {
                        $("#pokemon").append(`<option value=${data.results[i].name}>${data.results[i].name.toUpperCase()}</option>}`);
                    }
                }
                else if($("#gen").val() == 7) {
                    for (let i = 721; i < 809; i++) {
                        $("#pokemon").append(`<option value=${data.results[i].name}>${data.results[i].name.toUpperCase()}</option>}`);
                    }
                }
                else if($("#gen").val() == 8) {
                    for (let i = 809; i < 890; i++) {
                        $("#pokemon").append(`<option value=${data.results[i].name}>${data.results[i].name.toUpperCase()}</option>}`);
                    }
                }
            });
            
            $("#pokemon").on("change", async function() {
                let pokemon = $("#pokemon").val();
                let url = `https://pokeapi.co/api/v2/pokemon/${pokemon}`;
                let response = await fetch(url);     //retrieves Web API data in raw format
                let data = await response.json();  //converts the raw data into JSON format
                
                $("#species").empty();
                $("#dex").empty();
                $("#type").empty();
                $("#stats").empty();
                
                $("#species").append(`<h3>#${data.id} ${data.name.toUpperCase()}<h3>`);
                $("#dex").append(`<img id="sprite" src="${data.sprites.front_default}" /><br>`);
                if(data.types.length == 2) {
                    $("#type").append(`<h3>TYPE: ${data.types[0].type.name.toUpperCase()} / ${data.types[1].type.name.toUpperCase()}</h3>`);
                }
                else {
                    $("#type").append(`<h3>TYPE: ${data.types[0].type.name.toUpperCase()}</h3>`);
                }
                $("#stats").append(`
                    <table>
                        <tr>
                            <th colspan="2">Base Stats</th>
                        </tr>
                        <tr>
                            <td>HP:</td>
                            <td>${data.stats[0].base_stat}</td>
                        </tr>
                        <tr>
                            <td>ATTACK:</td>
                            <td>${data.stats[1].base_stat}</td>
                        </tr>
                        <tr>
                            <td>DEFENSE:</td>
                            <td>${data.stats[2].base_stat}</td>
                        </tr>
                        <tr>
                            <td>SP. ATTACK:</td>
                            <td>${data.stats[3].base_stat}</td>
                        </tr>
                        <tr>
                            <td>SP. DEFENSE:</td>
                            <td>${data.stats[4].base_stat}</td>
                        </tr>
                        <tr>
                            <td>SPEED:</td>
                            <td>${data.stats[5].base_stat}</td>
                        </tr>
                    </table>
                `);
            });
            
            fetchData();
            
        </script>
    </body>
</html>
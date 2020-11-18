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
        <h1>National PokeDex</h1>
        <select id="pokemon" name="pokemon">
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
            
            async function fetchData(){
                let url = `https://pokeapi.co/api/v2/pokemon?offset=0&limit=890`;
                let response = await fetch(url);     //retrieves Web API data in raw format
                let data = await response.json();  //converts the raw data into JSON format
                
                $("#pokemon").html("<option>Select One</option>");
                for (let i = 0; i < data.results.length; i++) {
                    $("#pokemon").append(`<option value=${data.results[i].name}>${data.results[i].name.toUpperCase()}</option>}`);
                }
                
            }
            
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
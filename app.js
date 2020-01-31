$(document).ready(function() {

    // when click button call function to seach player
    $('#search_form').submit(e => {
        e.preventDefault();
        $content = (document.getElementById('search_content').value);
        searchPlayer($content);
        });
    });
    
  //ajax function to search player, it sends the content entered to find the players in elastic search 
  function searchPlayer(content) {
    $.ajax({
      url: 'search_player.php',
      type: 'GET',
      data: {content: content},
      success: function(response) {
          let players = JSON.parse(response);
          let template = '';
          //if no players found
          if (players.length == 0)
          {
            template += `
            <thead>
            <tr>
              <th scope="col">There are no results that match your search</th>
            </tr>
          </thead>
          `
          }
          //if there is players then print the table in html
          else
          {
          
          template += `
          <thead class="thead-dark ">
          <tr>
            <th scope="col">DNI</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Position</th>
            <th scope="col">Number</th>
            <th scope="col">Club</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        `
          players.forEach(players => {
            template += `
            <tr>
            <td>${players.dni}</td>
            <td>${players.first_name}</td>
            <td>${players.last_name}</td>
            <td>${players.position}</td>
            <td>${players.number}</td>
            <td>${players.club}</td>
            <td>${players.status}</td>
            </tr>
          `
        });
      }
        $('#players').html(template);
      }
 
    });
    
  }
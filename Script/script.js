const battleBttn = document.getElementById('battle-button');
const battleBox = document.getElementById('box');
const battleText = battleBox.querySelector('p');
const topContent = document.querySelector('.top');
const activeBox = document.getElementById('active');
const pokemonSign = activeBox.querySelector('span');

var str = "PHP/Battle.php";

battleBttn.onclick = battleFunc;

function battleFunc () {

    changePage();
    var poke1 = document.getElementById('pokemon1').innerHTML; 
    var poke2 = document.getElementById('pokemon2').innerHTML;
    var newLine = createNewLine();

    newLine.innerHTML = `${poke1} vs ${poke2}`;
    battleBttn.innerHTML = `<a href="${str}">Next Turn</a>`;
    battleText.innerHTML = ' > Battle has started...'; 

    counter++;      
}

function changePage() {
    topContent.style.display = 'none';
    activeBox.style.width = '600px';
}

function createNewLine () {
    var line = document.createElement('p');
    battleBox.append(line);

    return line;
}
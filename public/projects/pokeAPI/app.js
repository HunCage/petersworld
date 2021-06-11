const apiData = {
    apiUrl: 'https://pokeapi.co/api/v2/',
    endPoint: 'pokemon/',
}
const randomPokemon = document.querySelector('.random-pokemon');

const pokeball = document.querySelector('.pokeball');

const generateRandomPokemon = () => {
    const url = apiData.apiUrl + apiData.endPoint + generateRandomNumber();
    fetch(url)
      .then((data) => data.json()) // console.log(data);
      .then((pokemon) => {
        displayPokemon(pokemon.name, pokemon.sprites.front_default);
        // console.log(pokemon.sprites.front_default);
      })
      .catch((err) => {
        console.error(err);
      });
};

const displayPokemon = (name, img) => {
    const html = `
        <h2>${name}</h2>
        <img src="${img}" alt="${name}">
    `;
    randomPokemon.innerHTML = html;
    // console.log(name, img);
}

const generateRandomNumber = () => Math.floor(Math.random() * 999 + 1);

pokeball.addEventListener('click', generateRandomPokemon);

generateRandomPokemon();
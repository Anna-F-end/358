    // ==UserScript==
// @name         По условию получение выдачи (рандомные запросы) виртEnter
// @namespace    http://tampermonkey.net/
// @version      2
// @description  try to take over the world!
// @author       Anna
// @match        https://ya.ru/*
// @match  https://cyberleninka.ru/*
// @match  https://alterainvest.ru/*

// @icon         data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==
// @grant        none
// ==/UserScript==

let sites = {"cyberleninka.ru": ["перевёрнутый урок",
                          "Перевернутое обучение путь интенсификации",
                          "Смешанное обучение химии в школе"],
             "cyberleninka.ru":["Таароф в иранской культуре",
                                "Ахмади Зейнаб таароф",
                               "речевой этикет в Иране"],
             "alterainvest.ru":["где зарабатывают миллионы",
                               "Идея для своего бизнеса: автоматы для сбора",
                                "Бизнес идеи 2023"]
            }
let site = Object.keys(sites)[getRandom(0, Object.keys(sites).length)];
let keywords = sites[site];
console.log("site: " +site);
let keyword = keywords[getRandom(0, keywords.length)];

let input3 = document.querySelector('input');

if (document.getElementsByClassName("HeaderDesktopNavigation HeaderDesktop-Navigation").length==0) {
//Страница поиска
input3.value=keyword;
input3.value+=" ";



console.log(input3);
 let event = new Event("click");
  input3.dispatchEvent(event);

/* input3.dispatchEvent(new Event('keydown', { bubbles: true, key: 'Enter' })); */
let timerId =setTimeout(() => {
    let keyboardBtn = document.getElementsByClassName("mini-suggest__action search3__keyboard search3__action")[0];
    console.log("keyboardBtn",keyboardBtn);
    keyboardBtn.click();      
} , 1000);
/* clearTimeout(timerId);     */

let timerForEnter = setTimeout(() => {
    let enterBtn = document.getElementsByClassName("keyboard__key keyboard__key_special-enter")[0];
    console.log("enterBtn",enterBtn);
    enterBtn.click();
    
    } , 2000);
/* clearTimeout(timerForEnter);    */
    
    
    
    
} //if HeaderDesktopNavigation 
else {
//Не на странице поиска
console.log("Не страница поиска (нет блока HeaderDesktop-Navigation)");
let links = document.links;
for (let i=0;i<links.length;i++){
    if (links[i].href.includes(site)) {
        let link = links[i];
        console.log("нашёл сайт!"+link);
        link.click();
        break;

}
}
}


function getRandom(min, max) {
  return Math.floor(Math.random() * (max - min) + min);
}
    



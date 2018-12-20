
function createNews (title, date, content, image) {
    var newNews = document.createElement('div');
    newNews.className = 'news';

    var newNewsHeader = document.createElement('h2');
    newNewsHeader.innerHTML = title;
    newNews.appendChild(newNewsHeader);

    var newNewsDate = document.createElement('p')
    newNewsDate.className = 'newsDate';
    newNewsDate.innerHTML = date;
    newNews.appendChild(newNewsDate);

    var newNewsImg = document.createElement('img');
    newNewsImg.src = 'images/' + image;
    newNews.appendChild(newNewsImg);

    var newNewsText = document.createElement('p');
    newNewsText.className = 'newsText';
    newNewsText.innerHTML = content;
    newNews.appendChild(newNewsText);

    document.getElementById('newsBlog').appendChild(newNews);
}

var title = 'Buy 1kg of steak and get 200g for free!';
var date = 'December 20,2018';
var content = 'If you buy 1kg of steak you get 200g extra for free.Don\'t miss it! <br>This special is valid from 20/12/2018 until 31/12/2018';
var image = 'beef-chopping-board-fillet-618775.jpg';

createNews(title,date,content,image);

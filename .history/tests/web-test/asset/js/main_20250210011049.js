$(document).ready(function () {
    loadArticles(false, window.screen.width);
});

// Biến đếm số trang để tải thêm bài viết
var countArticles = 1;

// Sự kiện khi nhấn nút "Tải thêm bài viết"
$("#PlusArticles").click(function () {
    countArticles += 1;
    loadArticles(false, window.screen.width);
});

// Sự kiện thay đổi thể loại bài viết
$("#Genero").on('change', function () {
    countArticles = 1;
    loadArticles(true, window.screen.width);
});

// Sự kiện tìm kiếm bài viết
$('#Pesquisar').on('input', function () {
    countArticles = 1;
    loadArticles(true, window.screen.width);
});

// Thay đổi bố cục khi thay đổi kích thước cửa sổ
$(window).resize(function () {
    var width = $(window).width();
    adjustLayout(width);
});

// Hàm tải bài viết từ file JSON
function loadArticles(clearArticles, w_width) {
    if (clearArticles) {
        $("#Articles").empty();
    }

    $.getJSON("asset/js/articles.json", function (data) {
        let startIndex = 0; // Bạn có thể thay đổi chỉ số này để phân trang
        let articlesToShow = data.slice(startIndex, startIndex + 6); // Giới hạn 6 bài viết mỗi lần

        articlesToShow.forEach(article => {
            let articleHtml = `
                <div class="col-md-4">
                    <div class="card mb-3 shadow-sm mt-3">
                        <img src="${article.image}" class="card-img-top" alt="${article.title}">
                        <div class="card-body">
                            <h5 class="card-title">${article.title}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">${article.category}</h6>
                            <p class="card-text">${article.content.substring(0, 100)}...</p>
                            <p class="card-text"><small class="text-muted">Tác giả: ${article.author} - ${article.published_date}</small></p>
                            <a href="article-detail.html?id=${article.id}" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            `;
            $("#Articles").append(articleHtml);
        });
    }).fail(function () {
        console.error("Không thể tải dữ liệu từ articles.json");
    });
}

// Hàm xác định số cột hiển thị dựa trên kích thước màn hình
function getColumnSize(w_width) {
    if (w_width <= 768) return 12;  // 1 cột trên màn hình nhỏ
    if (w_width > 768 && w_width <= 990) return 6; // 2 cột trên màn hình trung bình
    return 4; // 3 cột trên màn hình lớn
}

// Hàm điều chỉnh bố cục khi thay đổi kích thước cửa sổ
function adjustLayout(width) {
    $('#Articles').children().each(function () {
        $(this).attr('class', `col-${getColumnSize(width)}`);
    });
}


document.addEventListener("DOMContentLoaded", function () {
    loadPopularAuthors();
});

function loadPopularAuthors() {
    fetch("asset/js/authors.json")
        .then(response => response.json())
        .then(authors => {
            const authorsContainer = document.getElementById("PopularAuthors");
            authorsContainer.innerHTML = "";

            authors.forEach(author => {
                const authorCard = `
                    <div class="col-md-3">
                        <div class="author-card">
                            <img src="${author.image}" alt="${author.name}">
                            <h5>${author.name}</h5>
                            <p>${author.field}</p>
                        </div>
                    </div>
                `;
                authorsContainer.innerHTML += authorCard;
            });
        })
        .catch(error => console.error("Không thể tải dữ liệu từ authors.json", error));
}

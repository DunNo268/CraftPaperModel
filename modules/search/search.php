<div class="search-box">
    <form action="index.php?page_layout=product_search" method="POST">
        <button class="btn-search" type="submit" name="product_search" onclick="return validateSearch);">
            <svg xmlns="http://www.w3.org/2000/svg" height="0.875em" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
        </button>
        <input type="text" name="keyword" id="keyword" class="input-search" placeholder="Tìm kiếm Sản phẩm"><br>
        <span id="keyword_error"></span>
    </form>
</div>
<style>
.search-box{
  width: fit-content;
  height: fit-content;
  position: relative;
  box-sizing: border-box;
}
.input-search{
  height: 40px;
  width: 40px;
  border-style: none;
  font-size: 16px;
  letter-spacing: 2px;
  outline: none;
  border-radius: 25px;
  transition: all .5s ease-in-out;
  background-color: #222;
  padding-left: 15px;
  padding-right: 25px;
  color:#fff;
  box-sizing: border-box;
}
.input-search::placeholder{
  color:rgba(255,255,255,.5);
  font-size: 18px;
  letter-spacing: 2px;
  font-weight: 100;
  box-sizing: border-box;
}
.btn-search{
  width: 40px;
  height: 40px;
  border-style: none;
  font-size: 20px;
  font-weight: bold;
  outline: none;
  cursor: pointer;
  border-radius: 50%;
  position: absolute;
  right: 0px;
  color:#ffffff ;
  background-color:transparent;
  pointer-events: painted;  
  box-sizing: border-box;
}
.btn-search:focus ~ .input-search{
  width: 280px;
  border-radius: 0px;
  background-color: transparent;
  border-bottom:1px solid rgba(255,255,255,.5);
  transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
  box-sizing: border-box;
}
.input-search:focus{
  width: 280px;
  border-radius: 0px;
  background-color: transparent;
  border-bottom:1px solid rgba(255,255,255,.5);
  transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
  box-sizing: border-box;
}
</style>
<script>
    function validateSearch() {
        const EMPTY_STR = "";
        var check = true;
        var keyword = document.getElementById('keyword');
        var keyword_error = document.getElementById('keyword_error');
        if(keyword.value == EMPTY_STR) {
            keyword.style.border = "1px solid red";
            keyword_error.innerHTML = "Bạn phải nhập từ khoá tìm kiếm";
            keyword_error.style.color = "red";
            check = false;
        }
        return check;
    }
</script>
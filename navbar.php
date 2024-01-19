<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Navbar</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="fontawesome/css/all.min.css" />
    <style>
      nav {
        position: fixed;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-white warna1 fixed-top" >

      <div class="container">
      <h1 style="font-size: 40px">K-Vision</h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
            <i class="fa-solid fa-bars"></i>
            </span>
        </button>
        
        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
            <li class="nav-item me-4">
              <a
                class="nav-link"
                href="index.php"
                style="
                  color: rgb(27, 27, 27);
                  font-size: 20px;
                  font-weight: bold;
                  margin-left: 20px;
                  color:#402b3a;
                "
                >Home
              </a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                href="produk.php"
                style="
                  color: rgb(27, 27, 27);
                  font-size: 20px;
                  font-weight: bold;
                  margin-left: 10px;
                  color:##402b3a;
                "
                >Produk
              </a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                href="keranjang.php?"
                style="
                  color: rgb(27, 27, 27);
                  font-size: 20px;
                  font-weight: bold;
                  margin-left: 10px;
                  color:#402b3a;
                "
              >
                Keranjang
              </a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0 d-flex">
            <input
              class="form-control mr-sm-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
              Search
            </button>
          </form>
          
          <a href="logout.php"class="nav-link" style="font-size:20px; color:#402b3a;">Log Out<i class="fa-solid fa-right-from-bracket "></i></a>

            
          </ul>
        </div>
       
        

        <!-- <div
          class="collapse navbar-collapse justify-content-between"
          id="navbarSupportedContent"
        >
          
          
        </div> -->
      </div>
    </nav>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
  </body>
</html>

<script>
import "boxicons/css/boxicons.min.css";
import axios from "axios";
export default {
  data() {
    return {
      books: null,
      id: "",
      file_path: null,
      fileURL: "",
      latest_book: [],
      activeNavItem: null,
    };
  },
  mounted() {
    this.fetchBook();
    this.previewBook();
    this.fetchRecommendBook();
  },

  methods: {
    fetchBook() {
      const id = this.$route.params.id;
      console.log(id);
      axios
        .get(`http://localhost:8000/api/bookDetail/${id}`)
        .then((response3) => {
          this.books = response3.data;

          console.log(this.books);
        })
        .catch((error) => {
          console.error("Error fetching Book:", error);
        });
    },

    fetchRecommendBook() {
      axios
        .get(`http://localhost:8000/api/listarrivalBooks`)
        .then((response3) => {
          this.latest_book = response3.data.slice(0, 3);

          console.log(this.latest_book);
        })
        .catch((error) => {
          console.error("Error fetching Book:", error);
        });
    },

    getBookImageURL(books) {
      if (books.image) {
        const imageUrl = `http://localhost:8000/storage/${books.image}`;
        // console.log('Image URL:', imageUrl); // Log the image URL
        return imageUrl;
      } else if (books.image == null) {
        const imageAuto = `https://cdn-icons-png.flaticon.com/512/219/219970.png`;
        // console.log(imageAuto);
        return imageAuto;
      }
    },

    previewBook(file_path) {
      if (file_path) {
        fetch(`http://localhost:8000/api/previewBook/${file_path}`, {})
          .then((res) => {
            if (!res.ok) {
              throw new Error("Network response was not ok");
            }

            // Read the response body as a Blob
            return res.blob();
          })
          .then((blob) => {
            // Create an object URL for the Blob
            const objectURL = URL.createObjectURL(blob);
            this.fileURL = objectURL;

            // Open the Blob URL in a new window or tab
            // window.open(objectURL, '_blank');
          })
          .catch((error) => {
            console.error(
              "There was a problem with the fetch operation:",
              error
            );
          });
      }
    },

    scrollToTop() {
      // Get the target element by its id
      const targetElement = document.getElementById("home");

      // Check if the target element exists
      if (targetElement) {
        // Use smooth scroll behavior
        targetElement.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }

      this.activeNavItem = "home";
    },
  },
};
</script>

<template>
  <div>
    <section id="header">
      <div>
        <ul id="navbar">
          <li>
            <router-link :to="{ name: 'home' }">
              <a class="" href="">New Arrivals</a>
            </router-link>
          </li>
          <li>
            <router-link :to="{ name: 'event' }">
              <a class="" href="">Events</a>
            </router-link>
          </li>
        </ul>
      </div>

      <img style="justify-content: center; width: 150px" src="../../public/Library .png" alt="Image" />
      <div>
        <ul id="navbar">
          <li>
            <router-link :to="{ name: 'home' }">
              <a href="">Home</a>
            </router-link>
          </li>
          <li>
            <router-link :to="{ name: 'book' }"><a href="#" class="active">Book</a>
            </router-link>
          </li>
          <li>
            <router-link :to="{ name: 'about' }"><a href="#">About</a>
            </router-link>
          </li>
          <li>
            <router-link :to="{ name: 'contact' }"><a href="#">Contact</a>
            </router-link>
          </li>
          <li class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none" id="dropdownUser1"
              data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bx bx-user-circle"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-light text-small shadow" aria-labelledby="dropdownUser1"
              style="min-width: 0">
              <li class="mt-1">
                <router-link :to="{ name: 'login' }">
                  <a href="#" class="dropdown-item">
                    <span class="ms-1 d-none d-sm-inline text-sm">Login As Admin</span>
                  </a>
                </router-link>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div id="mobile">
        <a href=""><i class="fa-solid fa-bars"></i></a>
      </div>
    </section>

    <main class="limitation" v-if="books" id="home">
      <div class="align-box">
        <div class="product-box">
          <div class="product-image">
            <div class="main-img rounded-2xl">
              <img :src="getBookImageURL(books)" class="rounded-2xl mx-4 m-auto text-center mt-5 w-[210px] h-[180px]" />
            </div>
            <div class="mt-3">
              <div class="text-center m-auto border-2 border-dashed w-75">
                <i class="bx bx-file-blank mx-2 fs-3"></i>
                <button @click="previewBook(books.file_path)"
                  class="mx-2 text-decoration-none text-danger dashboard_textBox text-start" data-bs-toggle="modal"
                  data-bs-target="#staticBackdrop1">
                  {{ books.file_name }}
                </button>
              </div>
            </div>

            <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
              aria-labelledby="staticBackdropLabel1" aria-hidden="true">
              <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title text-center m-auto fs-2" id="staticBackdropLabel1">
                      {{ books.title }}
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <iframe v-if="fileURL != ''" :src="fileURL" width="100%" height="500"></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="product-detail">
            <h1>
              <span class="text-[#243673] fs-2">{{ books.title }}</span>
            </h1>
            <h6>(Limited Edition)</h6>
            <hr />
            <div class="size">
              <h1>Author</h1>
              <h4>{{ books.author }}</h4>
            </div>
            <div class="align-submit w-75">
              <hr />
              <h1 class="">
                Public Date:
                <span class="text-[#243673]">{{ books.release_year }}</span>
              </h1>

              <hr />
              <div class="price" style="
                  display: flex;
                  flex-direction: column !important;
                  margin: 0 !important;
                ">
                <h1>Description:</h1>
                <h6>{{ books.description }}</h6>
              </div>

              <button style="margin-top: 20px" @click="previewBook(books.file_path)" id="add_to_card"
                data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                Preview File
              </button>
              <!-- <button id="add_to_card" @click="downloadBook(books.file_path, books.file_name)">DOWNLOAD</button> -->
            </div>
          </div>
        </div>
        <div class="related">
          <h2>RECOMMEND BOOK</h2>
          <div class="related-box">
            <div class="box flex" v-for="(book, index) in latest_book" :key="index">
              <div class="main-img text-start">
                <img :src="getBookImageURL(book)" class="rounded-2xl mx-4 m-auto text-center mt-5 w-[210px] h-[180px]" />
                <div class="mx-5 mt-2">
                  <h6 class="fw-bold">
                    Title : <span class="font-normal"> {{ book.title }}</span>
                  </h6>
                  <span class="fw-bold">Author :
                    <span class="font-normal">{{ book.author }}</span></span>
                  <p class="fw-bold">
                    Release Year :
                    <span class="font-normal">{{ book.release_year }}</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <section class="bg-[#ccdee0] h-24 mt-5">

      <div class="px-4 py-6 flex justify-between ">

        <div class="mt-2">
          <div class="text-lg sm:text-center ">© {{ currentYear }}<a href="https://www.facebook.com/itckh?mibextid=ZbWKwL"
              class=" text-decoration-none"> &ensp; Library Website</a>. All Rights Reserved.
          </div>
        </div>

        <div class="flex mt-2 sm:justify-center md:mt-0 space-x-5 rtl:space-x-reverse">
          <a href="https://itc.edu.kh/">
            <i class="bx bxs-webcam fs-2 text-center m-auto "></i>
          </a>

          <a href="https://www.facebook.com/itckh?mibextid=ZbWKwL">
            <i class="bx bxl-meta fs-2 text-center m-auto "></i>
          </a>


          <a href="https://weibo.com/u/6333691724">
            <i class="bx bxl-reddit fs-2 text-center m-auto "></i>
          </a>

        </div>
      </div>


    </section>

    <button class="rounded-full position-sticky z-index-999 right-2 bottom-0" @click="scrollToTop">
      <i class='bx bx-up-arrow-circle fs-1 text-[#3a686e] p-2'></i>
    </button>
  </div>
</template>

<style>
.align-box {
  padding: 60px 30px;
}

.align-box .tag {
  margin-bottom: 20px;
}

.align-box .tag span:nth-child(2) {
  font-weight: 600;
}

.align-box .product-box {
  display: flex;
  flex-basis: 100%;
  gap: 20px;
  margin-bottom: 80px;
}

.align-box .product-box .product-image {
  flex: 3;
  display: flex;
  flex-direction: column;
}

.align-box .product-box .product-image .main-img {
  height: 500px;
  overflow: hidden;
  object-fit: contain;
  cursor: pointer;
  padding: 20px;
}

.align-box .product-box .product-image .main-img img {
  object-fit: contain;
  height: 100%;
  width: 100%;
  display: flex;
  justify-content: flex-start !important;
  align-items: flex-start !important;
  margin: 0 !important;
}

.align-box .product-box .product-image .bottom-img {
  height: 150px;
  padding: 20px;
  display: flex;
  gap: 20px;
  object-fit: cover;
  overflow: hidden;
  background: grey;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
}

.align-box .product-box .product-image .bottom-img .box {
  object-fit: cover;
  height: 100%;
}

.align-box .product-box .product-image .bottom-img .box img {
  height: 100%;
  object-fit: cover;
  cursor: pointer;
}

.align-box .product-box .product-detail {
  flex: 2;
}

.align-box .product-box .product-detail h1 {
  font-weight: 700;
  font-size: 24px;
}

.align-box .product-box .product-detail h6 {
  font-size: 18px;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 8;
  -webkit-box-orient: vertical;
  font-weight: 400;
}

.align-box .product-box .product-detail .align-box .product-box .product-detail hr {
  margin: 10px 0;
}

.align-box .product-box .product-detail .size {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  font-size: 14px;
  margin-bottom: 20px;
}

.align-box .product-box .product-detail .size p:nth-child(2) {
  text-decoration: underline;
  color: blue;
}

.align-box .product-box .product-detail .align-submit {
  width: 75%;
}

.align-box .product-box .product-detail .align-submit .button {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.align-box .product-box .product-detail .align-submit .button button {
  border: 1px solid gray;
  width: 100px;
  height: 25px;
}

.align-box .product-box .product-detail .align-submit hr {
  margin-top: 30px;
}

.align-box .product-box .product-detail .align-submit h5 {
  margin: 15px 0 !important;
  font-size: 14px;
}

.align-box .product-box .product-detail .align-submit .quantity {
  display: flex;
  margin-bottom: 50px;
}

.align-box .product-box .product-detail .align-submit .quantity div {
  width: 25px;
  height: 25px;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid gray;
}

.align-box .product-box .product-detail .align-submit .quantity div:nth-child(1) {
  border-right: none;
  width: 125px;
}

.align-box .product-box .product-detail .align-submit .quantity div:nth-child(2) {
  border-right: none;
  background: #000;
  color: #fff;
  cursor: pointer;
}

.align-box .product-box .product-detail .align-submit .quantity div:nth-child(3) {
  background: #000;
  color: #fff;
  cursor: pointer;
}

.align-box .product-box .product-detail .align-submit .price {
  display: flex;
  justify-content: space-between;

  width: 100%;
  font-size: 14px;
  margin-bottom: 180px;
}

#add_to_card {
  width: 100%;
  height: 40px;
  background: purple;
  border-radius: 20px;
  color: #fff;
}

@media (max-width: 830px) {
  .align-box {
    padding: 40px 20px;
  }

  .align-box .product-box {
    flex-direction: column;
  }

  .align-box .product-box .product-image .main-img {
    height: 350px;
  }

  .align-box .product-box .product-image .bottom-img {
    height: 120px;
  }

  .align-box .product-box .product-detail {
    position: relative;
  }

  #add_to_card {
    position: absolute;
    width: 100%;
    bottom: 40px;
  }
}

@media (max-width: 550px) {
  .align-box .product-box .product-image .main-img {
    height: 280px;
  }

  .align-box .product-box .product-image .bottom-img {
    height: 90px;
  }

  #add_to_card {
    bottom: 80px;
  }
}

.align-box .related {
  padding: 0 60px;
}

.align-box .related h2 {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 24px;
}

.align-box .related .related-box {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr;
  gap: 30px;
}

.align-box .related .related-box .box {}

.align-box .related .related-box .box .image {
  border-radius: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.align-box .related .related-box .box .image img {
  max-width: 120px;
  cursor: pointer;
  object-fit: contain;
  aspect-ratio: 9/16;
}

.align-box .related .related-box .box .text {
  padding: 10px;
  width: 100%;
  text-align: center;
}

.align-box .related .related-box .box .text h6 {
  font-size: 18px;
  font-weight: 600;
  cursor: pointer;
}

.align-box .related .related-box .box .text span {
  color: rgb(26, 126, 26);
  margin-bottom: 20px;
  font-size: 14px;
}

.align-box .related .related-box .box .text p {
  padding: 10px 0;
  font-size: 14px;
}

@media (max-width: 1200px) {
  .align-box .related .related-box {}
}

@media (max-width: 1000px) {
  .align-box .related .related-box {
    grid-template-columns: 1fr 1fr 1fr;
  }
}

@media (max-width: 830px) {
  .align-box .related {
    padding: 0 20px;
  }

  .align-box .related .related-box {
    grid-template-columns: 1fr 1fr;
  }
}

@media (max-width: 550px) {
  .align-box .related {
    padding: 0 10px;
  }

  .align-box .related .related-box {
    grid-template-columns: 1fr;
  }
}
</style>

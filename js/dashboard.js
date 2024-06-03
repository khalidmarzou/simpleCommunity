function id(id) {
  return document.getElementById(id);
}

const blogsContainer = id("blogs");
const blogs = Array.from(blogsContainer.getElementsByTagName("article"));

const filterBtns = Array.from(
  id("filterBtns").querySelectorAll('div[role="button"]')
);

const networkBlogs = Array.from(
  blogsContainer.querySelectorAll('input[name="network"]')
).map((input) => input.parentElement);

id("networkBlogs").textContent = "+" + networkBlogs.length;

for (let i = 0; i < filterBtns.length; i++) {
  filterBtns[i].onclick = function () {
    blogsContainer.innerHTML = "";
    filterBtns.forEach(function (btn) {
      if (btn.classList.contains("bg-purple-100")) {
        btn.classList.remove("bg-purple-100");
      }
    });
    this.classList.add("bg-purple-100");
    const category = this.textContent.match(/[a-z]+/i)[0];

    if (category == "All" || category == "MyNetwork") {
      if (category == "All") {
        blogsContainer.append(...blogs);
      } else {
        blogsContainer.append(...networkBlogs);
      }
    } else {
      const blogsSpecific = blogs.filter(function (blog) {
        return (
          blog.querySelector("#category").textContent.match(/[a-z]+/i)[0] ==
          category
        );
      });
      blogsContainer.append(...blogsSpecific);
    }
  };
}

function like(event) {
  const blog =
    event.target.parentElement.parentElement.parentElement.parentElement
      .parentElement;
  const BlogID = blog.id;
  let dataJSON;

  if (event.target.classList.contains("fa-regular")) {
    dataJSON = JSON.stringify({
      BlogID: BlogID,
      action: 1,
    });
  } else {
    dataJSON = JSON.stringify({
      BlogID: BlogID,
      action: 0,
    });
  }

  const options = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: dataJSON,
  };

  fetch("/api/like.api.php", options)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      if (data["status"] == 1) {
        if (event.target.classList.contains("fa-regular")) {
          event.target.classList.remove("fa-regular");
          event.target.classList.add("fa-solid");
          if (
            event.target.parentElement.nextElementSibling.nextElementSibling.firstElementChild.classList.contains(
              "fa-solid"
            )
          ) {
            event.target.parentElement.nextElementSibling.nextElementSibling.firstElementChild.classList.remove(
              "fa-solid"
            );
            event.target.parentElement.nextElementSibling.nextElementSibling.firstElementChild.classList.add(
              "fa-regular"
            );
          }
        } else {
          event.target.classList.remove("fa-solid");
          event.target.classList.add("fa-regular");
        }
      } else {
        alert("There is an error in Like button");
        console.log(data);
      }

      blog.querySelector("#reactionNB").textContent = data["reactionNB"];
      id("likeNB").textContent = data["likeNB"];
      blog
        .querySelector("#reactionNB")
        .classList.remove("text-red-700", "text-green-700");
      if (data["reactionNB"] >= 0) {
        blog.querySelector("#reactionNB").classList.add("text-green-700");
      } else {
        blog.querySelector("#reactionNB").classList.add("text-red-700");
      }
    })
    .catch((error) => {
      console.error("There was a problem with the fetch operation:", error);
    });
}

function dislike(event) {
  const blog =
    event.target.parentElement.parentElement.parentElement.parentElement
      .parentElement;
  const BlogID = blog.id;
  let dataJSON;

  if (event.target.classList.contains("fa-regular")) {
    dataJSON = JSON.stringify({
      BlogID: BlogID,
      action: 1,
    });
  } else {
    dataJSON = JSON.stringify({
      BlogID: BlogID,
      action: 0,
    });
  }

  const options = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: dataJSON,
  };

  fetch("/api/dislike.api.php", options)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      if (data["status"] == 1) {
        if (event.target.classList.contains("fa-regular")) {
          event.target.classList.remove("fa-regular");
          event.target.classList.add("fa-solid");
          if (
            event.target.parentElement.previousElementSibling.previousElementSibling.firstElementChild.classList.contains(
              "fa-solid"
            )
          ) {
            event.target.parentElement.previousElementSibling.previousElementSibling.firstElementChild.classList.remove(
              "fa-solid"
            );
            event.target.parentElement.previousElementSibling.previousElementSibling.firstElementChild.classList.add(
              "fa-regular"
            );
          }
        } else {
          event.target.classList.remove("fa-solid");
          event.target.classList.add("fa-regular");
        }
      } else {
        alert("There is an error in DisLike button");
        console.log(data);
      }

      blog.querySelector("#reactionNB").textContent = data["reactionNB"];
      id("likeNB").textContent = data["likeNB"];

      blog
        .querySelector("#reactionNB")
        .classList.remove("text-red-700", "text-green-700");
      if (data["reactionNB"] >= 0) {
        blog.querySelector("#reactionNB").classList.add("text-green-700");
      } else {
        blog.querySelector("#reactionNB").classList.add("text-red-700");
      }
    })
    .catch((error) => {
      console.error("There was a problem with the fetch operation:", error);
    });
}

function follow(event) {
  const blog = event.target.parentElement.parentElement.parentElement.parentElement;
  const BlogID = blog.id;
  const isFollowing = event.target.classList.contains("fa-regular");

  const dataJSON = JSON.stringify({
    BlogID: BlogID,
    action: isFollowing ? 1 : 0,
  });

  const options = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: dataJSON,
  };

  fetch("/api/follow.api.php", options)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      if (data["status"] == 1) {
        if (isFollowing) {
          event.target.classList.remove("fa-regular");
          event.target.classList.add("fa-solid");
        } else {
          event.target.classList.remove("fa-solid");
          event.target.classList.add("fa-regular");
        }
        id('followersNB').textContent = data['followersNB'];
      } else {
        alert("There is an error with the Follow button");
        console.error("Server error response:", data);
      }
    })
    .catch((error) => {
      console.error("There was a problem with the fetch operation:", error);
    });
}
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
      } else {
        alert("There is an error with the Follow button");
        console.error("Server error response:", data);
      }
    })
    .catch((error) => {
      console.error("There was a problem with the fetch operation:", error);
    });
}

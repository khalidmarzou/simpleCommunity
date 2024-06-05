function follow(event, targetFollow) {
  const isFollowing = event.target.classList.contains("bg-red-500");

  const dataJSON = JSON.stringify({
    targetFollow: targetFollow,
    action: isFollowing ? 0 : 1,
  });

  const options = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: dataJSON,
  };

  fetch("/api/follow.profile.api.php", options)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      if (data["status"] == 1) {
        document.getElementById("countFollowers").textContent =
          data["countFollowers"];
        if (isFollowing) {
          event.target.classList.remove("bg-red-500", "hover:bg-red-600");
          event.target.classList.add("bg-blue-500", "hover:bg-blue-600");
          event.target.textContent = "Follow";
        } else {
          event.target.classList.remove("bg-blue-500", "hover:bg-blue-600");
          event.target.classList.add("bg-red-500", "hover:bg-red-600");
          event.target.textContent = "Following";
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
      getCountLikesProfile(BlogID);
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
      getCountLikesProfile(BlogID);
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

function getCountLikesProfile(BlogID) {
  const options = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      BlogID: BlogID,
    }),
  };

  fetch("/api/getCountLikesProfile.api.php", options)
    .then((response) => response.json())
    .then((data) => {
      document.getElementById("countLikes").textContent = data["countLikes"];
      document.getElementById("countDislikes").textContent =
        data["countDislikes"];
    })
    .catch((error) => console.error(error));
}

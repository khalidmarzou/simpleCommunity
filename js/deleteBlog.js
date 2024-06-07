function deleteBlog(event, BlogID) {
  const blog =
    event.target.parentElement.parentElement.parentElement.parentElement;

  const dataJSON = JSON.stringify({
    BlogID: BlogID,
  });

  const options = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: dataJSON,
  };

  fetch("/api/deleteBlog.api.php", options)
    .then((response) => response.json())
    .then((data) => {
      if (data["status"] == 1) {
        blog.remove();
      } else {
        alert("There is a problem in delete Button");
      }
    })
    .catch((error) => console.error(error));
}

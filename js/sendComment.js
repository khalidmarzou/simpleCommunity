function sendComment(event) {
  const textarea = document.getElementById("comment");
  const comment = textarea.value;
  const blogID = event.target.closest("article").id;
  const options = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      Comment: comment,
      BlogID: blogID,
    }),
  };

  if (comment) {
    fetch("/api/sendComment.api.php", options)
      .then((response) => response.json())
      .then((data) => {
        getComments();
        textarea.value = "";
        return console.log(data);
      })
      .catch((error) => console.error(error));
  }
}

function getComments() {
  const searchParams = new URLSearchParams(window.location.search);
  const BlogID = searchParams.get("BlogID");

  const options = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: BlogID,
  };

  fetch("/api/getComments.api.php", options)
    .then((response) => response.json())
    .then((data) => {
      document.getElementById("containerComments").innerHTML = "";
      data.forEach((cmmt) => {
        let btnSpr;
        if (cmmt.forMe) {
          btnSpr = `<button id="delete" onclick="deleteComment(${cmmt.CommentID})"
                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50"
                        type="button">
                            <i class="fa-solid fa-trash"></i>
                    </button>`;
        } else {
          btnSpr = "";
        }
        document.getElementById("containerComments").innerHTML += `
        
                  <article class="p-6 text-base bg-white border-t border-gray-200 w-[80%]">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <a href="/profile?UserID=${cmmt.UserID}" class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold hover:underline"><img
                                    class="mr-2 w-6 h-6 rounded-full"
                                    src="${cmmt.Profile}"
                                    alt="${cmmt.LastName}">${cmmt.LastName} ${cmmt.FirstName}</a>
                            <p class="text-sm text-gray-600"><span>${cmmt.CommentDate}</span></p>
                        </div>
                        ${btnSpr}
                    </footer>
                    <p class="text-gray-500">${cmmt.CommentText}</p>
                  </article>
        
        `;
      });
    })
    .catch((error) => console.error(error));
}
document.addEventListener("DOMContentLoaded", getComments);

function deleteComment(a) {
  const confirmation = confirm("Are You Sure ??");
  if (confirmation) {
    const options = {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        CommentID: a,
      }),
    };

    fetch("/api/deleteComment.api.php", options)
      .then(function (response) {
        return response.json();
      })
      .then((data) => {
        if (data.status) {
          getComments();
        } else {
          alert("Problem in delete comment api");
        }
      })
      .catch((error) => {
        console.error(error);
      });
  }
}

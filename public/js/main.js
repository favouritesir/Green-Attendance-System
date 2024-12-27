const $ = (q) => document.querySelector(q);
const $$ = (q) => document.querySelectorAll(q);
const $post = (path, data, callback) => {
  fetch(`/api/${path}`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then((res) => res.json())
    .then((res) => callback(res));
};

//! This is the start to make a client class for Omeka
//* Class has create, getAll, getById.

// fetch = require("node-fetch"); // only needed when ran by node.
// const querystring = require("querystring"); // Uknown

class Client {
  constructor(settings) {
    this.api_key = "?key=" + settings.api_key;
    this.basePath = "http://localhost/omeka/api";
    this.resource = settings.resource;
  }
  request(url, options = {}) {
    let headers = {
      "Content-type": "application/json",
    };

    let config = {
      ...options,
      ...headers,
    };

    return fetch(url, config).then((res) => {
      if (res.ok) {
        return res.json();
      }
      throw new Error(res);
      return res.status;
    });
  }
  getAllItems() {
    // let qs = options ? "?" + querystring.stringify(options) : "";
    let url = this.basePath + "/" + this.resource + this.api_key;
    let options = {
      method: "GET",
      headers: { "Content-Type": "application/json" },
    };
    return this.request(url, options);
  }

  getItemById(id) {
    let url = this.basePath + "/" + this.resource + "/" + id + this.api_key;
    let options = {
      method: "GET",
      headers: { "Content-Type": "application/json" },
    };
    return this.request(url, options);
  }

  createItem(body) {
    let url = this.basePath + "/" + this.resource + this.api_key;
    const options = {
      method: "POST",
      body: JSON.stringify(body),
      headers: { "Content-Type": "application/json" },
    };
    return this.request(url, options);
    // Optional: add your own .catch to process/deliver errors or fallbacks specific to this resource
  }
}
// let api = new Client({
//   api_key: "43ca10306f312f2ac162de563a60e408db2c3d25",
//   resource: "items",
// });
// console.log(api);
// api.getAllItems().then((data) => console.log(data));
// api.getItemById("10").then((data) => console.log(data));
// api.createItem(body).then((data) => console.log(data));

// body = {
//   item_type: { id: 1 },

//   public: true,
//   featured: false,
//   tags: [{ name: "foo" }, { name: "bar" }],
//   element_texts: [
//     {
//       html: false,
//       text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
//       element: { id: 1 },
//     },
//   ],
// };

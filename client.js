//! This is the start to make a client class for Omeka
//* Class has create, getAll, getById.

/*
 *  let api = new Client({
 *    api_key: "43ca10306f312f2ac162de563a60e408db2c3d25",
 *    resource: "items",
 *  });
 *  console.log(api);
 *  api.getAllItems().then((data) => console.log(data));
 *  api.getItemById("10").then((data) => console.log(data));
 *  api.createItem(body).then((data) => console.log(data));
 */

class Client {
  constructor(settings) {
    this.api_key = "?key=" + settings.api_key;
    this.basePath =
      settings.basePath === null || ""
        ? "http://localhost/omeka/api"
        : settings.basePath;
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
      console.log(res);
      throw new Error(res);

      return res.status;
    });
  }
  getAllItems() {
    // let qs = options ? "?" + querystring.stringify(options) : "";
    // let url = this.basePath + "/" + this.resource + this.api_key;
    let url = this.basePath + "/" + this.resource;
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

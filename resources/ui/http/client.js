/*jshint esversion: 9*/

import axios from "axios";
const csrfToken = document.head.querySelector('meta[name="csrf-token"]');

const onRequestMonitor = request => {
  return request;
};

const onResponseReceivedMonitor = response => {
  return response;
};

const errorInterceptor = error => {
  switch (error.response.status) {
    case 400:
      break;

    case 401:
        window.location.reload()
      break;
    default:
  }

  return Promise.reject(error);
};

const responseInterceptor = response => {
  switch (response.status) {
    case 200:
      // console.log("Response Valid");
      break;
    default:
      // console.log("Response", response);
      break;
  }
};

const client = axios.create({
  baseURL: `${window.location.origin}`,
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json"
  }
});

client.interceptors.request.use(onRequestMonitor);
client.defaults.validateStatus = status => status >= 200 && status < 500;
client.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
client.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.content || "";

client.interceptors.response.use(
  onResponseReceivedMonitor,
  responseInterceptor,
  errorInterceptor
);

export default client;

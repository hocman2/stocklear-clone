import axios from 'axios';

axios.defaults.baseURL = "http://localhost:8000/api/";
axios.defaults.headers.common["Content-Type"] = "application/json";
axios.defaults.withCredentials = false;
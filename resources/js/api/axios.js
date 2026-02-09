import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: 'http://localhost:8000',
  headers: {
    'Content-Type': 'application/json',
    // 'Authorization': 'Bearer YOUR_TOKEN'
  },
  timeout: 10000, // 10 seconds
});

export default axiosInstance;

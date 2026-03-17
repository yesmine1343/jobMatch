import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: 'http://localhost:8000',
//  withCredentials: true,
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
  },
  timeout: 10000, // 10 seconds
});
// Add this
axiosInstance.interceptors.request.use(config => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});
export default axiosInstance;

import axios from "axios";
import { defineStore } from "pinia";

export const useSiswa = defineStore("siswa-store", () => {
  const getSiswa = async () => {
    try {
      const response = await axios.get("/v1/siswa");
      return response.data;
    } catch (error) {
      console.log(error);
    }
  };

  const storeSiswa = async (siswa) => {
    try {
      const response = await axios.post("/v1/siswa", siswa);
      return response;
    } catch (error) {
      console.log(error);
    }
  };

  const updateSiswa = async (id, siswa) => {
    try {
      const response = await axios.put(`/v1/siswa/${id}`, siswa);
      return response;
    } catch (error) {
      console.log(error);
    }
  };

  const deleteSiswa = async (id) => {
    try {
      const response = await axios.delete(`/v1/siswa/${id}`);
      return response;
    } catch (error) {
      console.log(error);
    }
  };

  return {
    getSiswa,
    storeSiswa,
    updateSiswa,
    deleteSiswa,
  };
});

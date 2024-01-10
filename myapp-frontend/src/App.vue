<script setup>
import { reactive, ref, onMounted } from 'vue';
import Table from './components/Table.vue';
import { useSiswa } from './http/stores/siswa';

const siswa = useSiswa();
const dataSiswa = ref([]);
const showModal = ref(false);
const setAddSiswaModal = (value) => {
  showModal.value = value;
};
const showModalEdit = ref(false);
const setEditSiswaModal = (value) => {
  showModalEdit.value = value;
};
const showAlert = (message) => {
  window.alert(message);
};

const formDataEdit = reactive({
  id: '',
  nama_depan: '',
  nama_belakang: '',
  alamat: '',
  telp: '',
  jk: 'L',
  kelas: '10-IPA-1',
  status: '1',
});


const formData = reactive({
  nama_depan: '',
  nama_belakang: '',
  alamat: '',
  telp: '',
  jk: 'L',
  kelas: '10-IPA-1',
  status: '1',
});

const fetchData = async () => {
  try {
    const response = await siswa.getSiswa();
    dataSiswa.value = response.data.map(siswa => ({
      ...siswa,
      nama: `${siswa.nama_depan || ''} ${siswa.nama_belakang || ''}`.trim(),
    }));
  } catch (error) {

  }
}

onMounted(async () => {
  await fetchData();
});

const columns = ref([
  {
    label: "Nama",
    field: "nama",
  },
  {
    label: "Alamat",
    field: "alamat",
  },
  {
    label: "No. Telp",
    field: "telp",
  },
  {
    label: "Gender",
    field: "jk",
  },
  {
    label: "Kelas",
    field: "kelas",
  },
  {
    label: "Action",
    field: "action",
  },
]);

const editRow = (row) => {
  const transformedJK = row.jk === 'Laki - Laki' ? 'L' : 'P';
  Object.assign(formDataEdit, {
    ...row,
    id: row.id,
    jk: transformedJK,
  });
  setEditSiswaModal(true);
};

const deleteRow = (row) => {
  const confirmDelete = window.confirm('Apakah Anda yakin ingin menghapus siswa ini?');

  if (confirmDelete) {
    deleteData(row.id);
  }
};

const submitData = async () => {
  try {
    const response = await siswa.storeSiswa(formData);
    if (response.status == 201) {
      setAddSiswaModal(false);
      formData.nama_depan = '';
      formData.nama_belakang = '';
      formData.alamat = '';
      formData.telp = '';
      formData.jk = 'L';
      formData.kelas = '10-IPA-1';
      formData.status = '1';

      await fetchData();
      showAlert('Siswa berhasil ditambahkan.');
    } else {
      showAlert('Siswa gagal ditambahkan.');
    }
  } catch (error) {
    setAddSiswaModal(false);
    await fetchData();
    showAlert('Terjadi kesalahan. Silakan coba lagi.');
  }
}

const submitEditData = async () => {
  try {
    const response = await siswa.updateSiswa(formDataEdit.id, formDataEdit);
    if (response.status == 200) {
      setEditSiswaModal(false);
      await fetchData();
      showAlert('Siswa berhasil diupdate.');
    } else {
      showAlert('Gagal mengupdate siswa.');
    }
  } catch (error) {
    console.log(error);
    showAlert('Terjadi kesalahan. Silakan coba lagi.');
  }
};

const deleteData = async (row) => {
  try {
    const response = await siswa.deleteSiswa(row);
    if (response.status == 204) {
      showAlert('Siswa berhasil dihapus.');
      await fetchData();
    } else {
      showAlert('Gagal menghapus siswa.');
    }
  } catch (error) {
    console.log(error);
    showAlert('Terjadi kesalahan. Silakan coba lagi.');
  }
};
</script>

<template>
  <div class="container mx-auto mt-5 p-5">
    <button @click="setAddSiswaModal(true)"
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-right">
      Tambah Siswa
    </button>
    <h1 class="text-2xl font-bold mb-5">Data Siswa</h1>
    <div class="mt-5">
      <Table :columns="columns" :rows="dataSiswa" :onEditRow="editRow" :onDeleteRow="deleteRow" />
    </div>
  </div>

  <div v-if="showModal" class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-[500px]"> <!-- Menambahkan kelas lebar modal -->
      <h2 class="text-2xl font-bold mb-4">Tambah Siswa</h2>
      <!-- Tombol close di dalam modal -->
      <button @click="setAddSiswaModal(false)" class="text-gray-500 hover:text-gray-700 absolute top-3 right-3">
        &times;
      </button>

      <form @submit.prevent="submitData">
        <label for="nama_depan">Nama Depan:*</label>
        <input type="text" v-model="formData.nama_depan" id="nama_depan" class="mb-3 p-2 border rounded w-full">

        <label for="nama_belakang">Nama Belakang:</label>
        <input type="text" v-model="formData.nama_belakang" id="nama_belakang" class="mb-3 p-2 border rounded w-full">

        <label for="alamat">Alamat:</label>
        <input type="text" v-model="formData.alamat" id="alamat" class="mb-3 p-2 border rounded w-full">

        <label for="telp">Telepon:</label>
        <input type="text" v-model="formData.telp" id="telp" class="mb-3 p-2 border rounded w-full">

        <label for="gender">Jenis Kelamin:</label>
        <select v-model="formData.jk" id="gender" class="mb-3 p-2 border rounded w-full">
          <option value="L">Laki-Laki</option>
          <option value="P">Perempuan</option>
        </select>

        <label for="kelas">Kelas:</label>
        <select v-model="formData.kelas" id="kelas" class="mb-3 p-2 border rounded w-full">
          <option value="10-IPA-1">10 IPA 1</option>
          <option value="10-IPA-2">10 IPA 2</option>
          <option value="10-IPA-3">10 IPA 3</option>
        </select>

        <label for="status">Status:</label>
        <select v-model="formData.status" id="status" class="mb-3 p-2 border rounded w-full">
          <option value="1">Aktif</option>
          <option value="0">Non-Aktif</option>
        </select>
        <small>* form wajib diisi</small>
        <div class="flex justify-end">
          <button type="button" @click="setAddSiswaModal(false)" class="text-gray-500 hover:text-gray-700 mr-3">
            Batal
          </button>
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>

  <div v-if="showModalEdit"
    class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-[500px]"> <!-- Menambahkan kelas lebar modal -->
      <h2 class="text-2xl font-bold mb-4">Tambah Siswa</h2>
      <!-- Tombol close di dalam modal -->
      <button @click="setEditSiswaModal(false)" class="text-gray-500 hover:text-gray-700 absolute top-3 right-3">
        &times;
      </button>

      <form @submit.prevent="submitEditData">
        <label for="nama_depan">Nama Depan:*</label>
        <input type="text" v-model="formDataEdit.nama_depan" id="nama_depan" class="mb-3 p-2 border rounded w-full">

        <label for="nama_belakang">Nama Belakang:</label>
        <input type="text" v-model="formDataEdit.nama_belakang" id="nama_belakang" class="mb-3 p-2 border rounded w-full">

        <label for="alamat">Alamat:</label>
        <input type="text" v-model="formDataEdit.alamat" id="alamat" class="mb-3 p-2 border rounded w-full">

        <label for="telp">Telepon:</label>
        <input type="text" v-model="formDataEdit.telp" id="telp" class="mb-3 p-2 border rounded w-full">

        <label for="gender">Jenis Kelamin:</label>
        <select v-model="formDataEdit.jk" id="gender" class="mb-3 p-2 border rounded w-full">
          <option value="L">Laki-Laki</option>
          <option value="P">Perempuan</option>
        </select>

        <label for="kelas">Kelas:</label>
        <select v-model="formDataEdit.kelas" id="kelas" class="mb-3 p-2 border rounded w-full">
          <option value="10-IPA-1">10 IPA 1</option>
          <option value="10-IPA-2">10 IPA 2</option>
          <option value="10-IPA-3">10 IPA 3</option>
        </select>

        <label for="status">Status:</label>
        <select v-model="formDataEdit.status" id="status" class="mb-3 p-2 border rounded w-full">
          <option value="1">Aktif</option>
          <option value="0">Non-Aktif</option>
        </select>
        <small>* form wajib diisi</small>
        <div class="flex justify-end">
          <button type="button" @click="setEditSiswaModal(false)" class="text-gray-500 hover:text-gray-700 mr-3">
            Batal
          </button>
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</template>


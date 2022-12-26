const Student = require("../models/Student");

class StudentController {
  async index(req, res) {
    const students = await Student.all();

    const data = {
      message: "Menampilkan semua students",
      data: students,
    };
    res.json(data);
  }

  async store(req, res) {
    const requests = {
      nama: req.body.nama,
      nim: req.body.nim,
      email: req.body.email,
      jurusan: req.body.jurusan,
    };
    const student = await Student.save(requests);
    const data = {
      message: `Menambahkan data student : ${req.body.nama}`,
      data: student,
    };
    res.json(data);
  }

  // update(req, res) {
  //   const { id } = req.params;
  //   const { nama } = req.body;
  //   students[id] = nama;
  //   const data = {
  //     message: `Mengedit student ${id}, nama ${nama}`,
  //     data: students,
  //   };
  //   res.json(data);
  // }

  async destroy(req, res) {
    const { id } = req.params;
    const result = await Student.delete(id);
    const data = {
      message: `Menghapus student id ${id}`,
      data: result,
    };
    res.json(data);
  }
}

const object = new StudentController();

module.exports = object;

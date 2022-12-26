const Student = require("../models/Student");

class StudentController {
  async index(req, res) {
    const students = await Student.all();
    if (students.length > 0) {
      const data = {
        message: "Menampilkan semua students",
        data: students,
      };
      return res.status(200).json(data);
    }
    const data = {
      message: "Students is empty",
    };
    return res.status(200).json(data);
  }
  async show(req, res) {
    const { id } = req.params;

    const student = await Student.find(id);

    if (student) {
      const data = {
        message: `Menemukan data students`,
        data: student,
      };
      res.status(200).json(data);
    } else {
      const data = {
        message: `Student not found`,
      };
      res.status(404).json(data);
    }
  }
  async store(req, res) {
    const { nama, nim, email, jurusan } = req.body;

    if (!nama || !nim || !email || !jurusan) {
      const data = {
        message: "semua data harus diisi",
      };
      return res.status(422).json(data);
    }
    const student = await Student.save(req.body);
    const data = {
      message: `Menambahkan data student : ${req.body.nama}`,
      data: student,
    };
    return res.status(201).json(data);
  }

  async update(req, res) {
    const { id } = req.params;

    const student = await Student.find(id);

    if (student) {
      const student = await Student.update(id, req.body);
      const data = {
        message: `Mengedit data students`,
        data: student,
      };
      res.status(200).json(data);
    } else {
      const data = {
        message: `Student not found`,
      };
      res.status(404).json(data);
    }
    //   const { nama } = req.body;
    //   students[id] = nama;
    //   const data = {
    //     message: `Mengedit student ${id}, nama ${nama}`,
    //     data: students,
    //   };
    //   res.json(data);
  }

  async destroy(req, res) {
    const { id } = req.params;
    const student = await Student.find(id);
    if (student) {
      await Student.delete(id);
      const data = {
        message: `Menghapus student id ${id}`,
      };
      res.status(200).json(data);
    } else {
      const data = {
        message: `Student not found`,
      };
      res.status(404).json(data);
    }
  }
}

const object = new StudentController();

module.exports = object;

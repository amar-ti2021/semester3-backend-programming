const db = require("../config/database");

class Student {
  static all() {
    return new Promise((resolve, reject) => {
      const query = "SELECT * FROM students";

      db.query(query, (error, results) => {
        resolve(results);
      });
    });
  }
  static save(data) {
    return new Promise((resolve, reject) => {
      const query = "Insert INTO students SET ?";

      db.query(query, data, (error, results) => {
        if (error) {
          reject(error);
        } else {
          resolve(data);
        }
      });
    });
  }
  static find(id) {
    return new Promise((resolve, reject) => {
      const query = `SELECT * FROM students WHERE id=${id}`;
      db.query(query, (error, results) => {
        if (error) {
          reject(error);
        } else {
          const [student] = results;
          resolve(student);
        }
      });
    });
  }

  static async update(id, data) {
    await new Promise((resolve, reject) => {
      const query = `UPDATE students SET ? WHERE id = ?`;
      db.query(query, [data, id], (error, results) => {
        if (error) {
          reject(error);
        } else {
          resolve(results);
        }
      });
    });

    const student = await this.find(id);
    return student;
  }
  static async delete(id) {
    try {
      return new Promise((resolve, reject) => {
        const query = `DELETE FROM students WHERE id=${id}`;
        db.query(query, (error, results) => {
          resolve(results);
        });
      });
    } catch (error) {
      return `Error : ${error}`;
    }
  }
}

module.exports = Student;

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
}

module.exports = Student;
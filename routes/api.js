const StudentController = require("../controllers/StudentController");

const express = require("express");
const router = express.Router();

router.get("/", (req, res) => {
  res.send("Hello Express");
});

router.get("/students", StudentController.index);

router.post("/students", StudentController.store);

router.put("/students/:id", StudentController.update);
router.get("/students/:id", StudentController.show);

router.delete("/students/:id", StudentController.destroy);

module.exports = router;

function formatDateDDMMYYHHMMSS(date) {
  // Get individual date components
  let day = date.getDate();
  let month = date.getMonth() + 1; // Months are zero-based
  let year = date.getFullYear() % 100; // Get the last two digits of the year

  // Add leading zeros if needed
  day = day < 10 ? "0" + day : day;
  month = month < 10 ? "0" + month : month;

  // Get individual time components
  let hours = date.getHours();
  let minutes = date.getMinutes();
  let seconds = date.getSeconds();

  // Add leading zeros if needed
  hours = hours < 10 ? "0" + hours : hours;
  minutes = minutes < 10 ? "0" + minutes : minutes;
  seconds = seconds < 10 ? "0" + seconds : seconds;

  // Construct the formatted date string
  let formattedDate =
    day +
    "-" +
    month +
    "-" +
    year +
    " " +
    hours +
    "." +
    minutes +
    "." +
    seconds;

  return formattedDate;
}

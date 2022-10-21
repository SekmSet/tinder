import axios from "axios";
import { GET_MESSAGE_IN_CONV, SEND_MESSAGE } from "../config";

const send = (sender, message, receiver) => {
  try {
    axios
      .post(SEND_MESSAGE, {
        sender,
        message,
        receiver,
      })
      .then((response) => console.log(response.data));
  } catch (e) {
    console.error("Error when send message : " + e);
  }
};

const getMessage = (id, idUserMatch) => {
  try {
    return axios
      .get(GET_MESSAGE_IN_CONV + `/${id}/${idUserMatch}`)
      .then((response) => console.log(response.data));
  } catch (e) {
    console.error("Error when send message : " + e);
  }
};

export { send, getMessage };

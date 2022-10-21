import axios from "axios";
import { MY_SETTINGS } from "../config";

const getUser = async () => {
  try {
    const fetch = await axios.get(MY_SETTINGS);
    // const stringify = JSON.stringify(fetch.data)
    // console.debug("stringify " + stringify)
    // console.debug("fetch " + fetch);
    // console.debug(stringify.images)
    return fetch.data;
  } catch (e) {
    //console.error("Error : " + e);
  }
};

export { getUser };

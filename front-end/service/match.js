import axios from "axios";
import { MATCH_URL, ACTION_LIKE_URL, MY_MATCHES_URL } from "../config";

const getUsers = async () => {
  try {
    const fetch = await axios.get(MATCH_URL);
    // const stringify = JSON.stringify(fetch.data)
    // console.debug("stringify " + stringify)
    console.debug("fetch " + fetch);
    // console.debug(stringify.images)
    return fetch.data;
  } catch (e) {
    //console.error("Error : " + e);
  }
};

const getMatches = async () => {
  try {
    const fetch = await axios.get(MY_MATCHES_URL);
    // const stringify = JSON.stringify(fetch.data)
    // console.debug("stringify " + stringify)
    console.debug("fetch " + fetch);
    // console.debug(stringify.images)
    return fetch.data;
  } catch (e) {
    //console.error("Error : " + e);
  }
};

const actionUserMatch = async ({ id, action, idUserMatch }) => {
  try {
    await axios.post(ACTION_LIKE_URL, {
      id,
      action,
      idUserMatch,
    });

    return await getUsers();
  } catch (e) {
    console.error("Error : " + e);
  }
};

export { getUsers, getMatches, actionUserMatch };

import React, { useEffect, useState } from "react";
import {
  StyleSheet,
  Button,
  View,
  SafeAreaView,
  Image,
  Text,
  ActivityIndicator,
} from "react-native";
import { actionUserMatch, getUsers } from "../../../service/match";

export const Index = () => {
  const [profils, setProfils] = useState([]);
  const [id, setId] = useState(1);

  const unLike = async (val) => {
    const newUsersList = await actionUserMatch({
      id: id,
      action: "unlike",
      idUserMatch: profils[0].id,
    });
    setProfils(newUsersList);
  };

  const superLike = async () => {
    const newUsersList = await actionUserMatch({
      id: id,
      action: "super like",
      idUserMatch: profils[0].id,
    });
    setProfils(newUsersList);
  };

  const like = async () => {
    const newUsersList = await actionUserMatch({
      id: id,
      action: "like",
      idUserMatch: profils[0].id,
    });
    setProfils(newUsersList);
  };

  useEffect(() => {
    const fetchData = async () => {
      const users = await getUsers();
      setProfils(users);
    };

    fetchData().catch(console.error);
  }, []);

  return (
    <SafeAreaView>
      {profils.length > 0 ? (
        <View style={styles.container}>
          <Image
            source={{ uri: profils[0].images[0].url }}
            style={{ width: 305, height: 400 }}
          />
          <Text>{profils[0]?.first_name}</Text>
          <Text>{profils[0]?.gender} </Text>
          <Button
            onPress={unLike}
            title="Unlike"
            color="#841584"
            accessibilityLabel="Unlike this profil and never seen yet this profil button"
          />

          <Button
            onPress={superLike}
            title="Super like"
            color="#841584"
            accessibilityLabel="Super like this profil button"
          />

          <Button
            onPress={like}
            title="Like"
            color="#841584"
            accessibilityLabel="Like this profil button"
          />
        </View>
      ) : (
        <View style={styles.container}>
          <ActivityIndicator
            style={styles.loader}
            size="large"
            color="#ff69b4"
          />
        </View>
      )}
    </SafeAreaView>
  );
};

const styles = StyleSheet.create({
  container: {
    height: "100%",
    borderRadius: 10,
    margin: 10,
    padding: 10,
  },
  loader: {
    justifyContent: "center",
    alignItems: "center",
    width: "100%",
    height: "100%",
  },
});

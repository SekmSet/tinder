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
import { getUser } from "../../../service/setting";

export const Profil = () => {
  const [profil, setProfil] = useState({});

  useEffect(() => {
    const fetchData = async () => {
      const users = await getUser();
      setProfil(users);
    };

    fetchData().catch(console.error);
  }, []);

  return (
    <SafeAreaView>
      {profil?.id ? (
        <View style={styles.container}>
          <Image
            source={{ uri: profil.images[0].url }}
            style={{ width: 305, height: 400 }}
          />
          <Text>{profil.first_name}</Text>
          <Text>{profil.gender} </Text>
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

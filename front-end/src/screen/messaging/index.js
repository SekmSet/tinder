import {
  StyleSheet,
  View,
  SafeAreaView,
  Text,
  Image,
  Button,
} from "react-native";
import React, { useEffect, useState } from "react";
import { getMatches } from "../../../service/match";
import Ionicons from "@expo/vector-icons/Ionicons";

export const ViewAllMessaging = ({ navigation }) => {
  const [profils, setProfils] = useState([]);

  const sendMessage = (value) => {
    navigation.navigate("Messagerie", {
      screen: "Create",
      params: {
        profil: value,
      },
    });
  };

  useEffect(() => {
    const fetchData = async () => {
      const users = await getMatches();
      setProfils(users);
    };

    fetchData().catch(console.error);
  }, []);

  // const viewMessages = (p) => {
  //   console.log(p, profils[0]);
  //   navigation.navigate("Detail", {
  //     params: {
  //       profil: p,
  //       idreceiver: 1,
  //     },
  //   });
  // };

  return (
    <SafeAreaView>
      <View style={styles.container}>
        {profils.map((profil) => (
          <View style={styles.match} key={profil.id}>
            <Image
              source={{ uri: profil.images[0].url }}
              style={{ width: 60, height: 60, borderRadius: 60 / 2 }}
            />
            <Text>
              {profil.last_name} {profil.first_name}
            </Text>
            <Ionicons.Button
              style={styles.iconButton}
              name="chatbubble-ellipses-outline"
              size={30}
              color="black"
              onPress={() => sendMessage(profil)}
            />
            {/*<Button*/}
            {/*  onPress={() => viewMessages(profil)}*/}
            {/*  title="Afficher les messages"*/}
            {/*></Button>*/}
          </View>
        ))}
      </View>
    </SafeAreaView>
  );
};

const styles = StyleSheet.create({
  container: {
    borderRadius: 10,
    margin: 10,
    padding: 10,
    // flex: 1,
    // flexDirection: "column",
  },
  iconButton: {
    backgroundColor: "white",
    borderColor: "black",
  },
});

import {
  StyleSheet,
  Button,
  View,
  SafeAreaView,
  Text,
  Alert,
  Image,
} from "react-native";
import React, { useEffect, useState } from "react";
import { getMatches } from "../../../service/match";

export const ViewAllMessaging = () => {
  const [profils, setProfils] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      const users = await getMatches();
      setProfils(users);
    };

    fetchData().catch(console.error);
  }, []);

  return (
    <SafeAreaView>
      <View style={styles.container}>
        {profils.map((profil) => (
          <View key={profil.id}>
            <Text>
              {profil.last_name} {profil.first_name} {profil.gender}
            </Text>
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
  },
});

import React from "react";
import "react-native-gesture-handler";
import { Provider as PaperProvider, DefaultTheme } from "react-native-paper";
import { createDrawerNavigator } from "@react-navigation/drawer";
import { NavigationContainer } from "@react-navigation/native";
import { createStackNavigator } from "@react-navigation/stack";
import * as ScreenOrientation from "expo-screen-orientation";
import { RootSiblingParent } from "react-native-root-siblings";

import {Index} from "./src/screen/home/index";
import {ViewAllMessaging} from "./src/screen/messaging";
import {ViewDetailMessaging} from "./src/screen/messaging/detail";
import {Profil} from "./src/screen/profil";

const Drawer = createDrawerNavigator();
const Stack = createStackNavigator();

const theme = {
    ...DefaultTheme,
    roundness: 0,
};

export default function App() {

    const createRouterMessaging = () => {
        return (
            <Stack.Navigator>
                <Stack.Screen name="Messagerie" component={ViewAllMessaging} />
                <Stack.Screen name="Detail" component={ViewDetailMessaging} />
            </Stack.Navigator>
        )
    }

    ScreenOrientation.unlockAsync()

    return (
        <RootSiblingParent>
            <PaperProvider theme={theme}>
                <NavigationContainer>
                    <Drawer.Navigator>
                        <Drawer.Screen name="Find a match" component={Index} />
                        <Drawer.Screen name="Messagerie" children={createRouterMessaging} />
                        <Drawer.Screen name="Profil" component={Profil} />
                    </Drawer.Navigator>
                </NavigationContainer>
            </PaperProvider>
        </RootSiblingParent>
  );
}
